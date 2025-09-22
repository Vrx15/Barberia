<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Listar productos para barbero
    public function index()
    {
        $productos = Producto::all();
        return view('barbero.productos.index', compact('productos'));
    }

    // Formulario de creación
    public function create()
    {
        return view('barbero.productos.create');
    }

    // Guardar producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'categoria' => 'required|string|max:100',
        ]);

        Producto::create($request->all());

        return redirect()->route('barbero.productos.index')
                         ->with('success', 'Producto creado correctamente');
    }

    // Formulario de edición
    public function edit(Producto $producto)
    {
        return view('barbero.productos.edit', compact('producto'));
    }

    // Actualizar producto
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'categoria' => 'required|string|max:100',
        ]);

        $producto->update($request->all());

        return redirect()->route('barbero.productos.index')
                         ->with('success', 'Producto actualizado correctamente');
    }

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('barbero.productos.index')
                         ->with('success', 'Producto eliminado correctamente');
    }
}



