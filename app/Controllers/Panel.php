<?php
namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use App\Models\ContratistaModel;
use App\Models\ClienteModel;

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
        // Si es contratista, recuperar datos completos (incluyendo foto_perfil)
        if ($user['rol'] === 'contratista') {
            $contratistaModel = new ContratistaModel();
            $full = $contratistaModel->find($user['id']);
            if (!empty($full)) {
                // mezclar datos para que la vista pueda usar $user['foto_perfil'] etc
                $user = array_merge($user, $full);
            }
        }
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

        // Obtener solicitudes abiertas recientes para mostrar en el panel
        $solicitudesDisponibles = $db->query("
            SELECT s.*, c.nombre as nombre_cliente 
            FROM SOLICITUD s
            JOIN CLIENTE c ON c.id_cliente = s.id_cliente
            WHERE s.id_contratista IS NULL 
            AND s.estado = 'ABIERTA'
            ORDER BY s.creado_en DESC
            LIMIT 5
        ")->getResultArray();

        return view('panel_contratista', [
            'user' => $user,
            'contracts' => $contracts,
            'reviews' => $reviews,
            'solicitudesDisponibles' => $solicitudesDisponibles,
            'message' => $message,
        ]);
    }

    public function subirImagen()
    {
        helper(['form', 'url']);
        $session = session();
        $user = $session->get('user');

        if (empty($user) || $user['rol'] !== 'contratista') {
            return redirect()->to('/')->with('error', 'Acceso no autorizado.');
        }

        $validationRules = [
            'imagen' => [
                'rules' => 'uploaded[imagen]|is_image[imagen]|max_size[imagen,5120]|mime_in[imagen,image/png,image/jpg,image/jpeg,image/webp]',
                'errors' => [
                    'uploaded' => 'Selecciona una imagen.',
                    'is_image' => 'El archivo debe ser una imagen.',
                    'max_size' => 'La imagen no puede superar 5MB.',
                    'mime_in' => 'Tipos permitidos: png, jpg, jpeg, webp.',
                ],
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $img = $this->request->getFile('imagen');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $newName = $img->getRandomName();
            // Guardar en public/images/profiles/
            $targetDir = FCPATH . 'images/profiles/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $img->move($targetDir, $newName);

            // Redimensionar y generar versiones
            try {
                $imgService = \Config\Services::image();
                $imgService->withFile($targetDir . $newName)->fit(300, 300, 'center')->save($targetDir . 'profile_' . $newName);
                $imgService->withFile($targetDir . $newName)->fit(64, 64, 'center')->save($targetDir . 'thumb_' . $newName);
            } catch (\Exception $e) {
                // Si falla el redimensionado, seguimos con el archivo original renombrado
                copy($targetDir . $newName, $targetDir . 'profile_' . $newName);
                copy($targetDir . $newName, $targetDir . 'thumb_' . $newName);
            }

            @unlink($targetDir . $newName);

            // Actualizar DB (campo foto_perfil en CONTRATISTA)
            $contratistaModel = new ContratistaModel();
            // Borrar imagen antigua si existe
            $old = $contratistaModel->find($user['id']);
            if (!empty($old['foto_perfil'])) {
                @unlink($targetDir . $old['foto_perfil']);
                @unlink($targetDir . 'thumb_' . preg_replace('/^profile_/', '', $old['foto_perfil']));
            }

            $contratistaModel->update($user['id'], ['foto_perfil' => 'profile_' . $newName]);

            // Actualizar sesión para que la navbar refleje el cambio inmediatamente
            $user['foto_perfil'] = 'profile_' . $newName;
            $session->set('user', $user);

            return redirect()->to('/panel')->with('message', 'Imagen de perfil actualizada.');
        }

        return redirect()->back()->with('error', 'Error al subir la imagen.');
    }

    public function editarPerfil()
    {
        $session = session();
        $user = $session->get('user');

        if (empty($user)) {
            return redirect()->to('/');
        }

        $data = [];
        if ($user['rol'] === 'cliente') {
            $model = new ClienteModel();
            $data['user'] = $model->find($user['id']);
            $data['user']['rol'] = 'cliente';
        } else {
            $model = new ContratistaModel();
            $data['user'] = $model->find($user['id']);
            $data['user']['rol'] = 'contratista';
        }

        return view('perfil_editar', $data);
    }

    public function actualizarPerfil()
    {
        $session = session();
        $user = $session->get('user');

        if (empty($user)) {
            return redirect()->to('/');
        }

        $rules = [
            'nombre' => 'required|min_length[3]',
            'telefono' => 'required|min_length[7]',
            'direccion' => 'required',
        ];

        if ($user['rol'] === 'contratista') {
            $rules['experiencia'] = 'required';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
            'ciudad' => $this->request->getPost('ciudad'),
        ];

        if ($user['rol'] === 'contratista') {
            $data['experiencia'] = $this->request->getPost('experiencia');
            $lat = $this->request->getPost('latitud');
            $lng = $this->request->getPost('longitud');
            if (!empty($lat) && !empty($lng)) {
                $data['latitud'] = $lat;
                $data['longitud'] = $lng;
            }
        }

        // Handle Image Upload
        $img = $this->request->getFile('foto_perfil');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $validationRule = [
                'foto_perfil' => [
                    'rules' => 'is_image[foto_perfil]|max_size[foto_perfil,5120]|mime_in[foto_perfil,image/png,image/jpg,image/jpeg,image/webp]',
                    'errors' => [
                        'is_image' => 'El archivo debe ser una imagen.',
                        'max_size' => 'La imagen no puede superar 5MB.',
                        'mime_in' => 'Tipos permitidos: png, jpg, jpeg, webp.',
                    ],
                ],
            ];
            if (!$this->validate($validationRule)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $newName = $img->getRandomName();
            $targetDir = FCPATH . 'images/profiles/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $img->move($targetDir, $newName);

            // Resize logic
            try {
                $imgService = \Config\Services::image();
                $imgService->withFile($targetDir . $newName)->fit(300, 300, 'center')->save($targetDir . 'profile_' . $newName);
                $imgService->withFile($targetDir . $newName)->fit(64, 64, 'center')->save($targetDir . 'thumb_' . $newName);
            } catch (\Exception $e) {
                copy($targetDir . $newName, $targetDir . 'profile_' . $newName);
                copy($targetDir . $newName, $targetDir . 'thumb_' . $newName);
            }
            @unlink($targetDir . $newName);

            $data['foto_perfil'] = 'profile_' . $newName;

            // Delete old image
            if ($user['rol'] === 'cliente') {
                $model = new ClienteModel();
            } else {
                $model = new ContratistaModel();
            }
            $oldUser = $model->find($user['id']);
            if (!empty($oldUser['foto_perfil'])) {
                @unlink($targetDir . $oldUser['foto_perfil']);
                @unlink($targetDir . 'thumb_' . preg_replace('/^profile_/', '', $oldUser['foto_perfil']));
            }
        }

        // Update DB
        try {
            if ($user['rol'] === 'cliente') {
                $model = new ClienteModel();
                $model->update($user['id'], $data);
            } else {
                $model = new ContratistaModel();
                $model->update($user['id'], $data);
            }

            // Update Session
            $updatedUser = $model->find($user['id']);
            if ($updatedUser) {
                $updatedUser['rol'] = $user['rol'];
                $session->set('user', $updatedUser);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar perfil: ' . $e->getMessage());
        }

        return redirect()->to('/perfil/editar')->with('message', 'Perfil actualizado correctamente.');
    }
}
