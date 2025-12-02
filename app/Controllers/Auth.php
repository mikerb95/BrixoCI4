<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function showLogin()
    {
        helper('form');
        $session = session();
        $data = [
            'login_error' => $session->getFlashdata('login_error'),
        ];

        return view('auth/login', $data);
    }

    public function login(): RedirectResponse
    {
        $session = session();
        $email = trim((string) $this->request->getPost('correo'));
        $password = (string) $this->request->getPost('contrasena');

        if ($email === '' || $password === '') {
            $session->setFlashdata('login_error', 'Debes ingresar el correo y la contraseña.');
            return redirect()->back();
        }

        $db = db_connect();
        $usuario = $db->table('CLIENTE')->where('correo', $email)->get()->getRowArray();
        $rol = 'cliente';

        if ($usuario === null) {
            $usuario = $db->table('CONTRATISTA')->where('correo', $email)->get()->getRowArray();
            $rol = $usuario === null ? '' : 'contratista';
        }

        if ($usuario === null) {
            $session->setFlashdata('login_error', 'No encontramos una cuenta asociada a ese correo.');
            return redirect()->back();
        }

        if (!password_verify($password, $usuario['contrasena'])) {
            $session->setFlashdata('login_error', 'La contraseña ingresada es incorrecta.');
            return redirect()->back();
        }

        if ($rol === 'cliente') {
            $session->set('user', [
                'id' => $usuario['id_cliente'],
                'nombre' => $usuario['nombre'],
                'correo' => $usuario['correo'],
                'rol' => 'cliente',
            ]);
        } else {
            $session->set('user', [
                'id' => $usuario['id_contratista'],
                'nombre' => $usuario['nombre'],
                'correo' => $usuario['correo'],
                'rol' => 'contratista',
            ]);
        }

        $session->regenerate();
        $session->setFlashdata('message', 'Inicio de sesión correcto. ¡Bienvenido!');

        return redirect()->to('/panel');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/')->with('message', 'Sesión cerrada.');
    }
}
