<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    // Apenas usuários que não estiverem logados
    // como admin poderão acessar as telas de login.
    public function __construct() {
        $this->middleware('guest:admin');
    }

    public function login(Request $request) {
        // Validar dados do formulário.
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Montar as credenciais do usuário.
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $authOk = Auth::guard('admin')->attempt($credentials, $request->remember);

        if ($authOk) { // Usuário conseguiu logar.
            return redirect()->intended(route('admin.dashboard'));
        }
        
        // Usuário não conseguiu logar.
        return redirect()->back()->withInputs($request->only('email', 'remember'));
    }

    public function validarLogin() {

    }

    // Mostrar tela de login.
    public function index() {
        return view('auth.admin-login');
    }
}
