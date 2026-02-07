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

        // ── Persistir en sesión con la descripción original ─────
        $session = session();
        $session->set('ultima_cotizacion', [
            'descripcion' => $descripcion,
            'data'        => $resultado['data'],
            'generada_en' => date('Y-m-d H:i:s'),
        ]);

        return $this->responder(true, $resultado['data']);
    }

    /**
     * POST /cotizador/confirmar – Confirma la cotización y guarda en BD.
     */
    public function confirmar(): ResponseInterface
    {
        $session = session();
        $user    = $session->get('user');
        $cot     = $session->get('ultima_cotizacion');

        // ── Validar que el usuario esté logueado ────────────────
        if (empty($user)) {
            return redirect()->to('/login')->with('error', 'Debes iniciar sesión para confirmar una cotización.');
        }

        // ── Validar que haya cotización en sesión ───────────────
        if (empty($cot) || empty($cot['data'])) {
            return redirect()->to('/cotizador')->with('error', 'No hay cotización para confirmar. Genera una primero.');
        }

        // ── Guardar en BD ───────────────────────────────────────
        $db = db_connect();

        // Crear tabla si no existe (idempotente)
        $this->ensureCotizacionesTable($db);

        $data = $cot['data'];

        $db->table('COTIZACION_CONFIRMADA')->insert([
            'id_cliente'         => $user['id'],
            'descripcion'        => $cot['descripcion'],
            'servicio_principal' => $data['servicio_principal'],
            'materiales_json'    => json_encode($data['materiales'], JSON_UNESCAPED_UNICODE),
            'personal_json'      => json_encode($data['personal'], JSON_UNESCAPED_UNICODE),
            'complejidad'        => $data['complejidad'],
            'estado'             => 'pendiente',
            'creado_en'          => $cot['generada_en'],
            'confirmado_en'      => date('Y-m-d H:i:s'),
        ]);

        $insertId = $db->insertID();

        // ── Limpiar sesión ──────────────────────────────────────
        $session->remove('ultima_cotizacion');

        // ── Redirigir a vista de éxito ──────────────────────────
        return redirect()->to('/cotizador/exito')->with('cotizacion_ok', [
            'id'                 => $insertId,
            'servicio_principal' => $data['servicio_principal'],
            'complejidad'        => $data['complejidad'],
            'materiales'         => $data['materiales'],
            'personal'           => $data['personal'],
            'descripcion'        => $cot['descripcion'],
        ]);
    }

    /**
     * GET /cotizador/exito – Vista de confirmación exitosa.
     */
    public function exito(): ResponseInterface|string
    {
        $session = session();
        $cot     = $session->getFlashdata('cotizacion_ok');

        if (empty($cot)) {
            return redirect()->to('/cotizador');
        }

        return view('cotizacion_exito', [
            'user'       => $session->get('user'),
            'cotizacion' => $cot,
        ]);
    }

    // ----------------------------------------------------------------
    // Helpers
    // ----------------------------------------------------------------

    /**
     * Crea la tabla COTIZACION_CONFIRMADA si no existe.
     */
    private function ensureCotizacionesTable($db): void
    {
        $db->query("
            CREATE TABLE IF NOT EXISTS COTIZACION_CONFIRMADA (
                id INT AUTO_INCREMENT PRIMARY KEY,
                id_cliente INT NULL,
                descripcion TEXT NOT NULL,
                servicio_principal VARCHAR(255) NOT NULL,
                materiales_json JSON NOT NULL,
                personal_json JSON NOT NULL,
                complejidad ENUM('bajo','medio','alto') NOT NULL DEFAULT 'medio',
                estado ENUM('pendiente','en_proceso','completada','cancelada') NOT NULL DEFAULT 'pendiente',
                creado_en DATETIME NOT NULL,
                confirmado_en DATETIME NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }

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
