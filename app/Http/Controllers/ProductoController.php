<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Listar productos para clientes
public function indexCliente()
{
    $productos = Producto::all(); // O filtra si quieres solo productos disponibles
    return view('productos.listado', compact('productos'));
}
    // Listar productos para barbero
    public function index()
    {
        $productos = Producto::paginate(10);
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
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validación de imagen
    ]);

    // Preparar datos
    $data = $request->all();

    // Subida de imagen
    if ($request->hasFile('imagen')) {
        $path = $request->file('imagen')->store('productos', 'public'); 
        $data['imagen'] = $path; // guardamos la ruta en el array de datos
    }

    Producto::create($data);

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
        if ($request->hasFile('imagen')) {
    if ($producto->imagen && file_exists(storage_path('app/public/' . $producto->imagen))) {
        unlink(storage_path('app/public/' . $producto->imagen));
    }
    $path = $request->file('imagen')->store('productos', 'public');
    $data['imagen'] = $path;
}

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



