<?php

namespace App\Http\Controllers;

use App\Models\Barbero;
use Illuminate\Http\Request;

class BarberoController extends Controller
{
    public function index()
    {
        $barberos = Barbero::all();
        return view('barberos.index', compact('barberos'));
    }

    public function create()
    {
        return view('barberos.create');
    }

    public function store(Request $request)
    {
        Barbero::create($request->all());
        return redirect()->route('barberos.index');
    }

    public function edit(Barbero $barbero)
    {
        return view('barberos.edit', compact('barbero'));
    }

    public function update(Request $request, Barbero $barbero)
    {
        $barbero->update($request->all());
        return redirect()->route('barberos.index');
    }

    public function destroy(Barbero $barbero)
    {
        $barbero->delete();
        return redirect()->route('barberos.index');
    }
}
