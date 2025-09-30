<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    // Listar ventas SOLO del barbero logueado
    public function index()
    {
        $ventas = Venta::with(['producto', 'barbero'])
            ->where('barbero_id', Auth::id()) // 👈 solo las del barbero en sesión
            ->orderBy('created_at', 'desc')
            ->get();

        return view('barbero.ventas.index', compact('ventas'));
    }

    // Formulario de creación
    public function create()
    {
        $productos = Producto::where('cantidad', '>', 0)->get();
        return view('barbero.ventas.create', compact('productos'));
    }

    // Guardar nueva venta
    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id_producto',
            'cantidad'   => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Validar stock
        if ($producto->cantidad < $request->cantidad) {
            return back()->withErrors(['cantidad' => 'Stock insuficiente para esta venta.']);
        }

        // Calcular total
        $total = $producto->precio * $request->cantidad;

        // Registrar venta a nombre del barbero autenticado
        Venta::create([
            'producto_id' => $producto->id_producto,
            'barbero_id'  => Auth::id(), // 👈 automáticamente el barbero en sesión
            'cantidad'    => $request->cantidad,
            'total'       => $total,
        ]);

        // Descontar stock
        $producto->decrement('cantidad', $request->cantidad);

        return redirect()->route('barbero.ventas.index')
                         ->with('success', 'Venta registrada con éxito.');
    }

    // Mostrar una venta
    public function show(Venta $venta)
    {
        $venta->load(['producto', 'barbero']);
        return view('barbero.ventas.show', compact('venta'));
    }

    // Eliminar una venta
    public function destroy(Venta $venta)
    {
        // Opcional: validar que solo el barbero dueño pueda borrar su venta
        if ($venta->barbero_id !== Auth::id()) {
            abort(403, 'No autorizado');
        }

        $venta->delete();
        return redirect()->route('barbero.ventas.index')
                         ->with('success', 'Venta eliminada correctamente.');
    }

    // Generar factura
    public function factura(Venta $venta)
    {
        $venta->load('producto', 'barbero'); // cargamos relaciones necesarias
        return view('barbero.ventas.factura', compact('venta'));
    }
}


