<?php

namespace App\Controllers;

class Productos extends BaseController
{
    public function index(): string
    {
        return view('productos');
    }
}