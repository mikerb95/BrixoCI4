<?php

namespace App\Controllers;

class AdminPanel extends BaseController
{
    public function index()
    {
        $session = session();
        $user = $session->get('user');

        if (! $user || $user['role'] !== 'admin') {
            return redirect()->to('/')->with('error', 'Acceso denegado.');
        }

        return view('admin/dashboard', ['user' => $user]);
    }
}