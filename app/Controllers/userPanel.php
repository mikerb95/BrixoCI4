<?php

namespace App\Controllers;

class UserPanel extends BaseController
{
    public function index()
    {
        $session = session();
        $user = $session->get('user');

        if (! $user) {
            return redirect()->to('/')->with('error', 'Debes iniciar sesión.');
        }

        return view('user/dashboard', ['user' => $user]);
    }
}