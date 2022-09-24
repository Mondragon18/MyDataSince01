<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $datos['cabecera'] = view('template/header');
        $datos['pie'] = view('template/footer');

        return view('welcome_message', $datos);
    }
}
