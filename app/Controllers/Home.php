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
            'register_error' => $session->getFlashdata('register_error'),
            'register_old' => $session->getFlashdata('register_old') ?? [],
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
                $confirmacion = (string) $this->request->getPost('contrasena_confirm');
                $rol = trim((string) $this->request->getPost('rol'));
                $ciudad = trim((string) $this->request->getPost('ciudad'));
                $ubicacionMapa = trim((string) $this->request->getPost('ubicacion_mapa'));

                $old = [
                    'nombre' => $nombre,
                    'correo' => $correo,
                    'telefono' => $telefono,
                    'rol' => $rol,
                    'ciudad' => $ciudad,
                    'ubicacion_mapa' => $ubicacionMapa,
                ];

                if ($nombre === '' || $correo === '' || $contrasena === '' || $confirmacion === '' || !in_array($rol, ['cliente', 'contratista'], true)) {
                    $session->setFlashdata('register_error', 'Completa todos los campos obligatorios y selecciona un tipo de cuenta válido.');
                    $session->setFlashdata('register_old', $old);

                    return redirect()->to('/');
                }

                if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    $session->setFlashdata('register_error', 'Ingresa un correo electrónico válido.');
                    $session->setFlashdata('register_old', $old);

                    return redirect()->to('/');
                }

                // Validación de contraseñas: coincidencia y fortaleza
                if ($contrasena !== $confirmacion) {
                    $session->setFlashdata('register_error', 'Las contraseñas no coinciden.');
                    $session->setFlashdata('register_old', $old);

                    return redirect()->to('/');
                }

                // Reglas de fortaleza: mínimo 8 caracteres, al menos una mayúscula, una minúscula, un dígito y un símbolo
                $lenOk = strlen($contrasena) >= 8;
                $upperOk = preg_match('/[A-Z]/', $contrasena) === 1;
                $lowerOk = preg_match('/[a-z]/', $contrasena) === 1;
                $digitOk = preg_match('/\d/', $contrasena) === 1;
                $symbolOk = preg_match('/[^A-Za-z0-9]/', $contrasena) === 1;
                if (!($lenOk && $upperOk && $lowerOk && $digitOk && $symbolOk)) {
                    $session->setFlashdata('register_error', 'La contraseña debe tener mínimo 8 caracteres e incluir mayúsculas, minúsculas, números y símbolos.');
                    $session->setFlashdata('register_old', $old);

                    return redirect()->to('/');
                }

                if ($rol === 'contratista' && ($ciudad === '' || $ubicacionMapa === '')) {
                    $session->setFlashdata('register_error', 'Los contratistas deben indicar la ciudad y la ubicación exacta en el mapa.');
                    $session->setFlashdata('register_old', $old);

                    return redirect()->to('/');
                }

                $existsCliente = $db->table('CLIENTE')->where('correo', $correo)->countAllResults();
                $existsContratista = $db->table('CONTRATISTA')->where('correo', $correo)->countAllResults();

                if ($existsCliente > 0 || $existsContratista > 0) {
                    $session->setFlashdata('register_error', 'Ese correo ya está registrado.');
                    $session->setFlashdata('register_old', $old);

                    return redirect()->to('/');
                }

                $hash = password_hash($contrasena, PASSWORD_DEFAULT);

                if ($rol === 'cliente') {
                    $db->table('CLIENTE')->insert([
                        'nombre' => $nombre,
                        'correo' => $correo,
                        'telefono' => $telefono,
                        'contrasena' => $hash,
                    ]);
                } else {
                    $db->table('CONTRATISTA')->insert([
                        'nombre' => $nombre,
                        'correo' => $correo,
                        'telefono' => $telefono,
                        'contrasena' => $hash,
                        'ciudad' => $ciudad,
                        'ubicacion_mapa' => $ubicacionMapa,
                    ]);
                }

                $session->setFlashdata('message', 'Cuenta creada correctamente. Ya puedes iniciar sesión.');

                return redirect()->to('/');
            }

            $email = trim((string) $this->request->getPost('correo'));
            $password = (string) $this->request->getPost('contrasena');

            if ($email === '' || $password === '') {
                $session->setFlashdata('login_error', 'Debes ingresar el correo y la contraseña.');

                return redirect()->to('/');
            }

            $usuario = $db->table('CLIENTE')->where('correo', $email)->get()->getRowArray();
            $rol = 'cliente';

            if ($usuario === null) {
                $usuario = $db->table('CONTRATISTA')->where('correo', $email)->get()->getRowArray();
                $rol = $usuario === null ? '' : 'contratista';
            }

            if ($usuario === null) {
                $session->setFlashdata('login_error', 'No encontramos una cuenta asociada a ese correo.');

                return redirect()->to('/');
            }

            if (!password_verify($password, $usuario['contrasena'])) {
                $session->setFlashdata('login_error', 'La contraseña ingresada es incorrecta.');

                return redirect()->to('/');
            }

            if ($rol === 'cliente') {
                $session->set('user', [
                    'id' => $usuario['id_cliente'],
                    'nombre' => $usuario['nombre'],
                    'correo' => $usuario['correo'],
                    'rol' => 'cliente',
                    'foto_perfil' => $usuario['foto_perfil'] ?? null,
                    'telefono' => $usuario['telefono'] ?? null,
                ]);
            } else {
                $session->set('user', [
                    'id' => $usuario['id_contratista'],
                    'nombre' => $usuario['nombre'],
                    'correo' => $usuario['correo'],
                    'rol' => 'contratista',
                    'foto_perfil' => $usuario['foto_perfil'] ?? null,
                    'telefono' => $usuario['telefono'] ?? null,
                    'ciudad' => $usuario['ciudad'] ?? null,
                    'ubicacion_mapa' => $usuario['ubicacion_mapa'] ?? null,
                ]);
            }

            $session->regenerate();
            $session->setFlashdata('message', 'Inicio de sesión correcto. ¡Bienvenido!');

            return redirect()->to('/panel');
        }

        $user = $session->get('user');
        if (!empty($user)) {
            $db = db_connect();
            if ($user['rol'] === 'cliente') {
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