<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider; // ✅ Correcto
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,correo'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'ruta_perfil' => ['nullable', 'string'],
        'id_rol' => ['required', 'exists:rols,id'],
    ]);

    $usuario = Usuario::create([
        'correo' => $request->correo,
        'password' => Hash::make($request->password),
        'ruta_perfil' => $request->ruta_perfil,
        'estado_cuenta' => 'activo',
        'id_rol' => $request->id_rol,
    ]);

    // 🔔 Lanza el evento Registered (opcional pero recomendado)
    event(new Registered($usuario));

    Auth::login($usuario);

    return redirect(RouteServiceProvider::HOME);
}

}
