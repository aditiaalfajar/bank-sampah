<?php

namespace Database\Seeders;

use App\Models\JenisSampah;
use App\Models\Nasabah;
use App\Models\Setoran;
use App\Models\Tarik;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@banksampah.id'],
            ['name' => 'Administrator', 'password' => Hash::make('password')]
        );

        $jenis = [
            ['nama' => 'Plastik', 'harga_per_kg' => 3000, 'satuan' => 'kg'],
            ['nama' => 'Kertas', 'harga_per_kg' => 2000, 'satuan' => 'kg'],
            ['nama' => 'Logam', 'harga_per_kg' => 8000, 'satuan' => 'kg'],
            ['nama' => 'Kaca', 'harga_per_kg' => 1000, 'satuan' => 'kg'],
            ['nama' => 'Kardus', 'harga_per_kg' => 1500, 'satuan' => 'kg'],
        ];
        foreach ($jenis as $j) {
            JenisSampah::firstOrCreate(['nama' => $j['nama']], $j);
        }

        Nasabah::firstOrCreate(['kode_nasabah' => 'SB-001'], ['nama' => 'Budi Santoso', 'alamat' => 'Jl. Melati No. 1', 'no_hp' => '081234567890']);
        Nasabah::firstOrCreate(['kode_nasabah' => 'SB-002'], ['nama' => 'Siti Aminah', 'alamat' => 'Jl. Mawar No. 5', 'no_hp' => '081298765432']);

        // Data contoh transaksi 6 bulan terakhir
        $nasabahs = Nasabah::all();
        $jeniss = JenisSampah::all();
        for ($i = 5; $i >= 0; $i--) {
            foreach ($nasabahs as $n) {
                foreach ($jeniss->random(2) as $j) {
                    $berat = rand(3, 20);
                    $total = $berat * $j->harga_per_kg;
                    Setoran::create([
                        'nasabah_id' => $n->id,
                        'jenis_sampah_id' => $j->id,
                        'tanggal' => now()->subMonths($i)->format('Y-m-d'),
                        'berat_kg' => $berat,
                        'harga_total' => $total,
                        'keterangan' => 'Setoran contoh',
                    ]);
                    $n->increment('saldo', $total);
                }
                if (rand(0, 1)) {
                    $tarik = min(10000, (int) $n->saldo);
                    if ($tarik > 0) {
                        Tarik::create(['nasabah_id' => $n->id, 'tanggal' => now()->subMonths($i)->format('Y-m-d'), 'jumlah' => $tarik, 'keterangan' => 'Tarik contoh']);
                        $n->decrement('saldo', $tarik);
                    }
                }
            }
        }
    }
}
