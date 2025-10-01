<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador;

class AdministradorPerfilController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('perfil_admin.index', compact('admin'));
    }

    public function edit()
    {
        $admin = Auth::user();
        return view('perfil_admin.edit', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = Auth::user();

        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo,' . $admin->id,
            'password' => 'nullable|min:6'
        ]);

        $admin->correo = $request->correo;
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->password);
        }

        $admin->save();

        return redirect()->route('admin.perfil.index')->with('success', 'Perfil actualizado correctamente.');
    }
}
