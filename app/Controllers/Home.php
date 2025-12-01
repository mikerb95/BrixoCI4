<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Home extends BaseController
{
    public function index(): string|RedirectResponse
    {
        helper('form');

        $session = session();
        $data = [
            'user' => $session->get('user'),
            'message' => $session->getFlashdata('message'),
            'error' => $session->getFlashdata('error'),
            'login_error' => $session->getFlashdata('login_error'),
            'userContracts' => [],
            'contractorContracts' => [],
        ];

        if ($this->request->getMethod() === 'post') {
            $action = (string) $this->request->getPost('action');
            $db = db_connect();

            if ($action === 'register') {
                $nombre = trim((string) $this->request->getPost('nombre'));
                $correo = trim((string) $this->request->getPost('correo'));
                $telefono = trim((string) $this->request->getPost('telefono'));
                $contrasena = (string) $this->request->getPost('contrasena');
                $rol = (string) $this->request->getPost('rol');

                if ($nombre === '' || $correo === '' || $contrasena === '' || ($rol !== 'cliente' && $rol !== 'contratista')) {
                    $session->setFlashdata('error', 'Completa todos los campos y selecciona un rol válido.');
                    return redirect()->to('/');
                }

                // Verificar correo único en ambas tablas
                $existsCliente = $db->table('CLIENTE')->where('correo', $correo)->countAllResults();
                $existsContratista = $db->table('CONTRATISTA')->where('correo', $correo)->countAllResults();

                if ($existsCliente > 0 || $existsContratista > 0) {
                    $session->setFlashdata('error', 'Ese correo ya está registrado.');
                    return redirect()->to('/');
                }

                $nuevo = [
                    'nombre' => $nombre,
                    'correo' => $correo,
                    'telefono' => $telefono,
                    'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT),
                    'fecha_registro' => date('Y-m-d H:i:s'),
                ];

                if ($rol === 'cliente') {
                    $db->table('CLIENTE')->insert($nuevo);
                } else {
                    $db->table('CONTRATISTA')->insert($nuevo);
                }

                $session->setFlashdata('message', 'Cuenta creada correctamente. Ya puedes iniciar sesión.');
                return redirect()->to('/');
            } else {
                // Login: Buscar en CLIENTE o CONTRATISTA
                $email = trim((string) $this->request->getPost('correo'));
                $password = (string) $this->request->getPost('contrasena');

                if ($email === '' || $password === '') {
                    $session->setFlashdata('error', 'Debes escribir el correo y la contraseña.');
                    return redirect()->to('/');
                }

                $usuario = null;
                $rol = '';
                $id = '';

                // Intentar como Cliente
                $cliente = $db->table('CLIENTE')->where('correo', $email)->get()->getRow();
                if ($cliente) {
                    $usuario = $cliente;
                    $rol = 'cliente';
                    $id = $cliente->id_cliente;
                } else {
                    // Intentar como Contratista
                    $contratista = $db->table('CONTRATISTA')->where('correo', $email)->get()->getRow();
                    if ($contratista) {
                        $usuario = $contratista;
                        $rol = 'contratista';
                        $id = $contratista->id_contratista;
                    }
                }

                if ($usuario !== null && password_verify($password, $usuario->contrasena)) {
                    $session->set('user', [
                        'id' => $id,
                        'nombre' => $usuario->nombre,
                        'correo' => $usuario->correo,
                        'rol' => $rol,
                        'foto_perfil' => $usuario->foto_perfil ?? null,
                        'telefono' => $usuario->telefono ?? null,
                    ]);
                    $session->setFlashdata('message', 'Inicio de sesión correcto.');
                    return redirect()->to('/panel');
                }

                $session->setFlashdata('error', 'Las credenciales no coinciden con la base de datos.');
                return redirect()->to('/');
            }
        }

        // Si existe usuario en sesión, traer algunos contratos para paneles
        $user = $session->get('user');
        if (!empty($user)) {
            $db = db_connect();
            if ($user['rol'] === 'cliente') {
                // Contratos del cliente
                $data['userContracts'] = $db->query(
                    'SELECT ct.id_contrato, ct.estado, ct.fecha_inicio, ct.fecha_fin, ct.costo_total,
                            "Servicio contratado" as detalle,
                            con.nombre as contratista
                     FROM CONTRATO ct
                     JOIN CONTRATISTA con ON con.id_contratista = ct.id_contratista
                     WHERE ct.id_cliente = ?
                     ORDER BY ct.fecha_inicio DESC
                     LIMIT 5',
                    [$user['id']]
                )->getResultArray();
            } elseif ($user['rol'] === 'contratista') {
                // Contratos del contratista
                $data['contractorContracts'] = $db->query(
                    'SELECT ct.id_contrato, ct.estado, ct.fecha_inicio, ct.fecha_fin, ct.costo_total,
                            "Servicio contratado" as detalle,
                            cli.nombre as cliente
                     FROM CONTRATO ct
                     JOIN CLIENTE cli ON cli.id_cliente = ct.id_cliente
                     WHERE ct.id_contratista = ?
                     ORDER BY ct.fecha_inicio DESC
                     LIMIT 5',
                    [$user['id']]
                )->getResultArray();
            }
        }

        return view('index', $data);
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to('/')->with('message', 'Sesión cerrada.');
    }
}