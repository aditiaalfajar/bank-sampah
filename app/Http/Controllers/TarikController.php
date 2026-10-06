<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Tarik;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TarikController extends Controller
{
    public function index(): View
    {
        $tariks = Tarik::with('nasabah')->latest()->paginate(10);
        return view('tarik.index', compact('tariks'));
    }

    public function create(): View
    {
        $nasabahs = Nasabah::orderBy('nama')->get();
        return view('tarik.create', compact('nasabahs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $nasabah = Nasabah::findOrFail($data['nasabah_id']);
        if ($data['jumlah'] > $nasabah->saldo) {
            return back()->withErrors(['jumlah' => 'Saldo nasabah tidak mencukupi. Saldo saat ini: Rp ' . number_format($nasabah->saldo, 0, ',', '.')])->withInput();
        }

        DB::transaction(function () use ($data, $nasabah) {
            Tarik::create($data);
            $nasabah->decrement('saldo', $data['jumlah']);
        });

        return redirect()->route('tarik.index')->with('success', 'Penarikan saldo berhasil dicatat.');
    }

    public function destroy(Tarik $tarik): RedirectResponse
    {
        DB::transaction(function () use ($tarik) {
            Nasabah::where('id', $tarik->nasabah_id)->increment('saldo', $tarik->jumlah);
            $tarik->delete();
        });
        return redirect()->route('tarik.index')->with('success', 'Penarikan dihapus dan saldo dikembalikan.');
    }
}
