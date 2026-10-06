<?php

namespace App\Http\Controllers;

use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\Tarik;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaporanController extends Controller
{
    public function index(Request $request): View
    {
        $jenis = $request->query('jenis', 'setoran');
        $dari = $request->query('dari');
        $sampai = $request->query('sampai');
        $nasabahId = $request->query('nasabah_id');

        $nasabahs = Nasabah::orderBy('nama')->get();

        if ($jenis === 'tarik') {
            $data = Tarik::with('nasabah')
                ->when($dari, fn ($q) => $q->whereDate('tanggal', '>=', $dari))
                ->when($sampai, fn ($q) => $q->whereDate('tanggal', '<=', $sampai))
                ->when($nasabahId, fn ($q) => $q->where('nasabah_id', $nasabahId))
                ->orderBy('tanggal')->get();
        } elseif ($jenis === 'rekap') {
            $data = Nasabah::orderBy('nama')
                ->when($nasabahId, fn ($q) => $q->where('id', $nasabahId))
                ->get();
        } else {
            $data = Setoran::with(['nasabah', 'jenisSampah'])
                ->when($dari, fn ($q) => $q->whereDate('tanggal', '>=', $dari))
                ->when($sampai, fn ($q) => $q->whereDate('tanggal', '<=', $sampai))
                ->when($nasabahId, fn ($q) => $q->where('nasabah_id', $nasabahId))
                ->orderBy('tanggal')->get();
        }

        return view('laporan.index', compact('jenis', 'dari', 'sampai', 'nasabahId', 'nasabahs', 'data'));
    }

    public function cetak(Request $request): View
    {
        $jenis = $request->query('jenis', 'setoran');
        $dari = $request->query('dari');
        $sampai = $request->query('sampai');
        $nasabahId = $request->query('nasabah_id');

        if ($jenis === 'tarik') {
            $data = Tarik::with('nasabah')
                ->when($dari, fn ($q) => $q->whereDate('tanggal', '>=', $dari))
                ->when($sampai, fn ($q) => $q->whereDate('tanggal', '<=', $sampai))
                ->when($nasabahId, fn ($q) => $q->where('nasabah_id', $nasabahId))
                ->orderBy('tanggal')->get();
        } elseif ($jenis === 'rekap') {
            $data = Nasabah::orderBy('nama')
                ->when($nasabahId, fn ($q) => $q->where('id', $nasabahId))
                ->get();
        } else {
            $data = Setoran::with(['nasabah', 'jenisSampah'])
                ->when($dari, fn ($q) => $q->whereDate('tanggal', '>=', $dari))
                ->when($sampai, fn ($q) => $q->whereDate('tanggal', '<=', $sampai))
                ->when($nasabahId, fn ($q) => $q->where('nasabah_id', $nasabahId))
                ->orderBy('tanggal')->get();
        }

        return view('laporan.cetak', compact('jenis', 'dari', 'sampai', 'data'));
    }
}
