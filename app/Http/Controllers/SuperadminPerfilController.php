<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Superadmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SuperadminPerfilController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        return view('superadmin.index', compact('usuario'));
    }

    public function edit()
    {
        $usuario = Auth::user();
        return view('superadmin.edit', compact('usuario'));
    }

    public function update(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'correo' => 'required|email',
            'password' => 'nullable|min:6|confirmed'
        ]);

        $usuario->correo = $request->correo;

        if ($request->password) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('superadmin.perfil.index')->with('success', 'Perfil actualizado correctamente');
    }
}
