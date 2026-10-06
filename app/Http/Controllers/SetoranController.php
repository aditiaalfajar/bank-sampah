<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use App\Models\Nasabah;
use App\Models\Setoran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SetoranController extends Controller
{
    public function index(): View
    {
        $setorans = Setoran::with(['nasabah', 'jenisSampah'])->latest()->paginate(10);
        return view('setor.index', compact('setorans'));
    }

    public function create(): View
    {
        $nasabahs = Nasabah::orderBy('nama')->get();
        $jenis = JenisSampah::orderBy('nama')->get();
        return view('setor.create', compact('nasabahs', 'jenis'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nasabah_id' => 'required|exists:nasabahs,id',
            'jenis_sampah_id' => 'required|exists:jenis_sampahs,id',
            'tanggal' => 'required|date',
            'berat_kg' => 'required|numeric|min:0.01',
            'keterangan' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($data) {
            $jenis = JenisSampah::findOrFail($data['jenis_sampah_id']);
            $data['harga_total'] = (int) round($data['berat_kg'] * $jenis->harga_per_kg);
            Setoran::create($data);
            Nasabah::where('id', $data['nasabah_id'])->increment('saldo', $data['harga_total']);
        });

        return redirect()->route('setor.index')->with('success', 'Setoran berhasil dicatat, saldo nasabah bertambah.');
    }

    public function destroy(Setoran $setor): RedirectResponse
    {
        DB::transaction(function () use ($setor) {
            Nasabah::where('id', $setor->nasabah_id)->decrement('saldo', $setor->harga_total);
            $setor->delete();
        });
        return redirect()->route('setor.index')->with('success', 'Setoran dihapus dan saldo disesuaikan.');
    }
}
