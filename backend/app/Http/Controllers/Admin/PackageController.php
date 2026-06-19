<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'naziv' => 'required|unique:packages,naziv',
            'cena' => 'required|numeric|min:0',
            'trajanje_dana' => 'required|integer|min:1',
            'tip' => 'required|in:M,G,D,T',
            'broj_treninga' => 'nullable|integer|min:1',
        ]);

        Package::create([
            'naziv' => $request->naziv,
            'opis' => $request->opis,
            'cena' => $request->cena,
            'trajanje_dana' => $request->trajanje_dana,
            'broj_treninga' => $request->tip === 'T'
                ? $request->broj_treninga
                : null,
            'tip' => $request->tip,
            'aktivan' => true,
        ]);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Paket je uspešno dodat.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'naziv' => 'required|unique:packages,naziv,' . $package->id,
            'cena' => 'required|numeric|min:0',
            'trajanje_dana' => 'required|integer|min:1',
            'tip' => 'required|in:M,G,D,T',
            'broj_treninga' => 'nullable|integer|min:1',
        ]);

        $package->update([
            'naziv' => $request->naziv,
            'opis' => $request->opis,
            'cena' => $request->cena,
            'trajanje_dana' => $request->trajanje_dana,
            'broj_treninga' => $request->tip === 'T'
                ? $request->broj_treninga
                : null,
            'tip' => $request->tip,
        ]);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Paket je ažuriran.');
    }

    public function toggle(Package $package)
    {
        $package->update([
            'aktivan' => ! $package->aktivan,
        ]);

        return back();
    }
}
