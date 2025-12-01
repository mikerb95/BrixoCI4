<?php

namespace App\Controllers;

class Info extends BaseController
{
    public function sobreNosotros()
    {
        return view('info/sobre_nosotros');
    }

    public function comoFunciona()
    {
        return view('info/como_funciona');
    }

    public function seguridad()
    {
        return view('info/seguridad');
    }

    public function ayuda()
    {
        return view('info/ayuda');
    }

    public function unetePro()
    {
        return view('info/unete_pro');
    }

    public function historiasExito()
    {
        return view('info/historias_exito');
    }

    public function recursos()
    {
        return view('info/recursos');
    }
}
