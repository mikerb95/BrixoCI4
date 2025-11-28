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
            'user'    => $session->get('user'),
            'message' => $session->getFlashdata('message'),
            'error'   => $session->getFlashdata('error'),
        ];

        if ($this->request->getMethod() === 'post') {
            $email = trim((string) $this->request->getPost('correo'));
            $password = (string) $this->request->getPost('contrasena');

            if ($email === '' || $password === '') {
                $session->setFlashdata('error', 'Debes escribir el correo y la contraseña.');

                return redirect()->to('/');
            }

            $builder = db_connect()->table('ADMINISTRADOR');
            $usuario = $builder
                ->select('id_administrador as id, nombre, correo, contrasena, "admin" as role')
                ->where('correo', $email)
                ->get()
                ->getRow();

            if ($usuario === null) {
                // Intentar como Contratista
                $builder = db_connect()->table('CONTRATISTA');
                $usuario = $builder
                    ->select('id_contratista as id, nombre, correo, contrasena, "contratista" as role')
                    ->where('correo', $email)
                    ->get()
                    ->getRow();
            }

            if ($usuario === null) {
                // Intentar como Cliente
                $builder = db_connect()->table('CLIENTE');
                $usuario = $builder
                    ->select('id_cliente as id, nombre, correo, contrasena, "cliente" as role')
                    ->where('correo', $email)
                    ->get()
                    ->getRow();
            }

            if ($usuario !== null && password_verify($password, $usuario->contrasena)) {
                $session->set('user', [
                    'id'     => $usuario->id,
                    'nombre' => $usuario->nombre,
                    'correo' => $usuario->correo,
                    'role'   => $usuario->role,
                ]);
                $session->setFlashdata('message', 'Inicio de sesión correcto.');

                if ($usuario->role === 'admin') {
                    return redirect()->to('/admin/dashboard');
                }
                
                return redirect()->to('/user/dashboard');
            }

            $session->setFlashdata('error', 'Las credenciales no coinciden con la base de datos.');

            return redirect()->to('/');
        }

        return view('index', $data);
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to('/')->with('message', 'Sesión cerrada.');
    }
}