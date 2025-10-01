<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class AdministradorController extends Controller
{
    public function index()
    {
        $admins = Administrador::where('id_rol', 2)->get();
        return view('administradores.index', compact('admins'));
    }

    public function create()
    {
        return view('administradores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|min:6',
        ]);

        Administrador::create([
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'ruta_perfil' => '',
            'estado_cuenta' => 'activo',
            'id_rol' => 2,
        ]);

        return redirect()->route('administradores.index')->with('success', 'Administrador agregado.');
    }

    public function edit($id)
    {
        $admin = Administrador::findOrFail($id);
        return view('administradores.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Administrador::findOrFail($id);
        $request->validate([
            'correo' => 'required|email|unique:usuarios,correo,' . $id,
        ]);

        $admin->correo = $request->correo;
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('administradores.index')->with('success', 'Administrador actualizado.');
    }
        public function toggleEstado($id)
    {
        $admin = Administrador::findOrFail($id);

        $admin->estado_cuenta = $admin->estado_cuenta === 'activo' ? 'inactivo' : 'activo';
        $admin->save();

        return back()->with('success', 'Estado actualizado correctamente.');
    }

    public function exportarPDF()
    {
        $admins = Administrador::where('id_rol', 2)->get();
        $pdf = Pdf::loadView('administradores.reporte', compact('admins'));
        return $pdf->stream('reporte_administradores.pdf');
    }

    public function verPDF()
    {
        return $this->exportarPDF(); // Reutilizamos lógica
    }
}
