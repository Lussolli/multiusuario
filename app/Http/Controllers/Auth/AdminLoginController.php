<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    // Apenas usuários que não estiverem logados
    // como admin poderão acessar as telas de login.
    public function __construct() {
        $this->middleware('guest:admin');
    }

    public function login(Request $request) {
        return response('OK');
    }

    // Mostrar tela de login.
    public function index() {
        return view('auth.admin-login');
    }
}
