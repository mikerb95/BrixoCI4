<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Panel extends BaseController
{
    public function index(): string|RedirectResponse
    {
        $session = session();
        $user = $session->get('user');
        if (empty($user)) {
            return redirect()->to('/');
        }

        $db = db_connect();
        if ($user['rol'] === 'cliente') {
            $contracts = $db->query(
                'SELECT ct.id_contrato, ct.estado, ct.fecha_inicio, ct.fecha_fin, ct.costo_total,
                        c.descripcion as detalle,
                        u.nombre as contratista
                 FROM CONTRATO ct
                 JOIN COTIZACION c ON c.id_cotizacion = ct.id_cotizacion
                 JOIN USUARIO u ON u.id_usuario = ct.id_contratista
                 WHERE c.id_cliente = ?
                 ORDER BY ct.fecha_inicio DESC',
                [$user['id']]
            )->getResultArray();

            $reviews = $db->query(
                'SELECT r.calificacion, r.comentario, r.fecha_resena,
                        u.nombre as contratista
                 FROM RESENA r
                 JOIN CONTRATO ct ON ct.id_contrato = r.id_contrato
                 JOIN USUARIO u ON u.id_usuario = ct.id_contratista
                 WHERE r.id_cliente = ?
                 ORDER BY r.fecha_resena DESC',
                [$user['id']]
            )->getResultArray();

            return view('panel_cliente', [
                'user' => $user,
                'contracts' => $contracts,
                'reviews' => $reviews,
            ]);
        }

        // Contratista
        $contracts = $db->query(
            'SELECT ct.id_contrato, ct.estado, ct.fecha_inicio, ct.fecha_fin, ct.costo_total,
                    c.descripcion as detalle,
                    u.nombre as cliente
             FROM CONTRATO ct
             JOIN COTIZACION c ON c.id_cotizacion = ct.id_cotizacion
             JOIN USUARIO u ON u.id_usuario = c.id_cliente
             WHERE ct.id_contratista = ?
             ORDER BY ct.fecha_inicio DESC',
            [$user['id']]
        )->getResultArray();

        $reviews = $db->query(
            'SELECT r.calificacion, r.comentario, r.fecha_resena,
                    u.nombre as cliente
             FROM RESENA r
             JOIN CONTRATO ct ON ct.id_contrato = r.id_contrato
             JOIN USUARIO u ON u.id_usuario = ct.id_cliente
             WHERE r.id_contratista = ?
             ORDER BY r.fecha_resena DESC',
            [$user['id']]
        )->getResultArray();

        return view('panel_contratista', [
            'user' => $user,
            'contracts' => $contracts,
            'reviews' => $reviews,
        ]);
    }
}
