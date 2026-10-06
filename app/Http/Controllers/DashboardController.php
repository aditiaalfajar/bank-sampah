<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\Tarik;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalNasabah = Nasabah::count();
        $totalSaldo = Nasabah::sum('saldo');
        $totalSetoranBulanIni = Setoran::whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->sum('harga_total');
        $totalTarikBulanIni = Tarik::whereMonth('tanggal', now()->month)->whereYear('tanggal', now()->year)->sum('jumlah');
        $setorTerbaru = Setoran::with(['nasabah', 'jenisSampah'])->latest()->take(5)->get();
        $nasabahTop = Nasabah::orderByDesc('saldo')->take(5)->get();
        $jenisSampah = JenisSampah::orderBy('nama')->get();

        return view('dashboard', compact(
            'totalNasabah', 'totalSaldo', 'totalSetoranBulanIni', 'totalTarikBulanIni',
            'setorTerbaru', 'nasabahTop', 'jenisSampah'
        ));
    }
}
