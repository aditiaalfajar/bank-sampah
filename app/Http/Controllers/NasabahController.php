<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NasabahController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');
        $nasabahs = Nasabah::when($search, fn ($q) => $q->where('nama', 'like', "%$search%")->orWhere('kode_nasabah', 'like', "%$search%"))
            ->latest()->paginate(10);
        return view('nasabah.index', compact('nasabahs', 'search'));
    }

    public function create(): View
    {
        return view('nasabah.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'kode_nasabah' => 'required|string|unique:nasabahs,kode_nasabah',
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);
        Nasabah::create($data);
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function edit(Nasabah $nasabah): View
    {
        return view('nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, Nasabah $nasabah): RedirectResponse
    {
        $data = $request->validate([
            'kode_nasabah' => 'required|string|unique:nasabahs,kode_nasabah,' . $nasabah->id,
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
        ]);
        $nasabah->update($data);
        return redirect()->route('nasabah.index')->with('success', 'Data nasabah berhasil diperbarui.');
    }

    public function destroy(Nasabah $nasabah): RedirectResponse
    {
        $nasabah->delete();
        return redirect()->route('nasabah.index')->with('success', 'Nasabah berhasil dihapus.');
    }

    public function show(Nasabah $nasabah): View
    {
        $setorans = $nasabah->setorans()->with('jenisSampah')->latest()->get();
        $tariks = $nasabah->tariks()->latest()->get();
        return view('nasabah.show', compact('nasabah', 'setorans', 'tariks'));
    }
}
