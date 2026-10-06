<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\Tarik;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $totalNasabah = Nasabah::count();
        $totalSaldo = Nasabah::sum('saldo');
        $totalSetoran = Setoran::sum('harga_total');
        $totalBerat = Setoran::sum('berat_kg');

        // Grafik setoran 6 bulan terakhir
        $bulanLabels = [];
        $bulanData = [];
        for ($i = 5; $i >= 0; $i--) {
            $d = Carbon::now()->subMonths($i);
            $bulanLabels[] = $d->translatedFormat('M Y');
            $bulanData[] = (int) Setoran::whereMonth('tanggal', $d->month)->whereYear('tanggal', $d->year)->sum('harga_total');
        }

        // Grafik komposisi jenis sampah berdasarkan total berat
        $komposisi = Setoran::select('jenis_sampah_id', DB::raw('SUM(berat_kg) as total'))
            ->groupBy('jenis_sampah_id')->get();
        $jenisLabels = [];
        $jenisData = [];
        foreach ($komposisi as $k) {
            $jenisLabels[] = JenisSampah::find($k->jenis_sampah_id)->nama ?? '-';
            $jenisData[] = (float) $k->total;
        }

        $riwayatTerbaru = Setoran::with(['nasabah', 'jenisSampah'])->latest()->take(5)->get();

        return view('home', compact(
            'totalNasabah', 'totalSaldo', 'totalSetoran', 'totalBerat',
            'bulanLabels', 'bulanData', 'jenisLabels', 'jenisData', 'riwayatTerbaru'
        ));
    }
}
