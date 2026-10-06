<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JenisSampahController extends Controller
{
    public function index(): View
    {
        $jenis = JenisSampah::latest()->paginate(10);
        return view('jenis.index', compact('jenis'));
    }

    public function create(): View
    {
        return view('jenis.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_per_kg' => 'required|integer|min:0',
            'satuan' => 'nullable|string|max:20',
            'keterangan' => 'nullable|string|max:255',
        ]);
        JenisSampah::create($data);
        return redirect()->route('jenis.index')->with('success', 'Jenis sampah berhasil ditambahkan.');
    }

    public function edit(JenisSampah $jenis): View
    {
        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, JenisSampah $jenis): RedirectResponse
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_per_kg' => 'required|integer|min:0',
            'satuan' => 'nullable|string|max:20',
            'keterangan' => 'nullable|string|max:255',
        ]);
        $jenis->update($data);
        return redirect()->route('jenis.index')->with('success', 'Jenis sampah berhasil diperbarui.');
    }

    public function destroy(JenisSampah $jenis): RedirectResponse
    {
        $jenis->delete();
        return redirect()->route('jenis.index')->with('success', 'Jenis sampah berhasil dihapus.');
    }
}
