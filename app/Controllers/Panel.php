<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Panel extends BaseController
{
    public function index(): string|RedirectResponse
    {
        $session = session();
        $user = $session->get('user');
        $message = $session->getFlashdata('message');
        if (empty($user)) {
            return redirect()->to('/');
        }

        $db = db_connect();
        if ($user['rol'] === 'cliente') {
            $contracts = $db->query(
                "SELECT ct.id_contrato, ct.estado, ct.fecha_inicio, ct.fecha_fin, ct.costo_total,
                        'Servicio contratado' as detalle,
                        con.nombre as contratista
                 FROM CONTRATO ct
                 JOIN CONTRATISTA con ON con.id_contratista = ct.id_contratista
                 WHERE ct.id_cliente = ?
                 ORDER BY ct.fecha_inicio DESC",
                [$user['id']]
            )->getResultArray();

            $reviews = $db->query(
                'SELECT r.calificacion, r.comentario, r.fecha as fecha_resena,
                        con.nombre as contratista
                 FROM RESENA r
                 JOIN CONTRATO ct ON ct.id_contrato = r.id_contrato
                 JOIN CONTRATISTA con ON con.id_contratista = ct.id_contratista
                 WHERE r.id_cliente = ?
                 ORDER BY r.fecha DESC',
                [$user['id']]
            )->getResultArray();

            $solicitudes = $db->query(
                "SELECT * FROM SOLICITUD WHERE id_cliente = ? ORDER BY creado_en DESC",
                [$user['id']]
            )->getResultArray();

            return view('panel_cliente', [
                'user' => $user,
                'contracts' => $contracts,
                'reviews' => $reviews,
                'solicitudes' => $solicitudes,
                'message' => $message,
            ]);
        }

        // Contratista
        $contracts = $db->query(
            "SELECT ct.id_contrato, ct.estado, ct.fecha_inicio, ct.fecha_fin, ct.costo_total,
                    'Servicio contratado' as detalle,
                    cli.nombre as cliente
             FROM CONTRATO ct
             JOIN CLIENTE cli ON cli.id_cliente = ct.id_cliente
             WHERE ct.id_contratista = ?
             ORDER BY ct.fecha_inicio DESC",
            [$user['id']]
        )->getResultArray();

        $reviews = $db->query(
            'SELECT r.calificacion, r.comentario, r.fecha as fecha_resena,
                    cli.nombre as cliente
             FROM RESENA r
             JOIN CONTRATO ct ON ct.id_contrato = r.id_contrato
             JOIN CLIENTE cli ON cli.id_cliente = r.id_cliente
             WHERE ct.id_contratista = ?
             ORDER BY r.fecha DESC',
            [$user['id']]
        )->getResultArray();

        return view('panel_contratista', [
            'user' => $user,
            'contracts' => $contracts,
            'reviews' => $reviews,
            'message' => $message,
        ]);
    }
}
