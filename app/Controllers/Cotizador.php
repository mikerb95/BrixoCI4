<?php

namespace App\Controllers;

use App\Libraries\LlmService;
use CodeIgniter\HTTP\ResponseInterface;

class Cotizador extends BaseController
{
    /**
     * GET /cotizador – Muestra el formulario.
     */
    public function index(): string
    {
        $session = session();
        return view('cotizador', [
            'user' => $session->get('user'),
        ]);
    }

    /**
     * POST /cotizador/generar – Recibe la descripción y devuelve la cotización JSON.
     *
     * Acepta tanto peticiones AJAX (responde JSON) como form POST (responde la vista).
     */
    public function generar(): ResponseInterface|string
    {
        // ── Validar CSRF y entrada ──────────────────────────────
        $rules = [
            'descripcion' => 'required|min_length[10]|max_length[2000]',
        ];

        if (!$this->validate($rules)) {
            return $this->responder(false, null, 'La descripción debe tener al menos 10 caracteres.');
        }

        $descripcion = trim((string) $this->request->getPost('descripcion'));

        // ── Llamar al LLM ───────────────────────────────────────
        $llm       = new LlmService();
        $resultado = $llm->generarCotizacion($descripcion);

        if (!$resultado['ok']) {
            return $this->responder(false, null, $resultado['error']);
        }

        return $this->responder(true, $resultado['data']);
    }

    // ----------------------------------------------------------------
    // Helper de respuesta
    // ----------------------------------------------------------------

    /**
     * Responde en JSON (AJAX) o redirige con datos (form clásico).
     */
    private function responder(bool $ok, ?array $data, ?string $error = null): ResponseInterface|string
    {
        // Si es petición AJAX → JSON
        if ($this->request->isAJAX()) {
            $payload = $ok
                ? ['ok' => true, 'data' => $data]
                : ['ok' => false, 'error' => $error];

            return $this->response->setJSON($payload);
        }

        // Petición normal → renderizar vista con resultado
        $session = session();
        return view('cotizador', [
            'user'         => $session->get('user'),
            'descripcion'  => $this->request->getPost('descripcion'),
            'cotizacion'   => $ok ? $data : null,
            'error'        => $ok ? null : $error,
        ]);
    }
}
