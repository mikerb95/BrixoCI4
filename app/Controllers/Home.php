<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Home extends BaseController
{
    public function index(): string
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

        return view('index', $data);
    }
}