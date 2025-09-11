<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        return Producto::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'precio' => 'required|numeric',
            'cantidad' => 'required|integer',
            'categoria' => 'required|string|max:50',
            'nombre' => 'required|string|max:100',
        ]);

        return Producto::create($request->all());
    }

    public function show($id)
    {
        return Producto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return $producto;
    }

    public function destroy($id)
    {
        return Producto::destroy($id);
    }
}
