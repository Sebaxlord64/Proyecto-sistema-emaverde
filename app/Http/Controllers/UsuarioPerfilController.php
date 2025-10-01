<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioPerfilController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        return view('usuario_perfil.index', compact('usuario'));
    }

    public function edit()
    {
        $usuario = Auth::user();
        return view('usuario_perfil.edit', compact('usuario'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $usuario->correo = $request->correo;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('usuario.perfil.index')->with('success', 'Perfil actualizado correctamente.');
    }
}
