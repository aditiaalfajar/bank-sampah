<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Setoran extends Model
{
    use HasFactory;

    protected $fillable = ['nasabah_id', 'jenis_sampah_id', 'tanggal', 'berat_kg', 'harga_total', 'keterangan'];

    public function nasabah(): BelongsTo
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function jenisSampah(): BelongsTo
    {
        return $this->belongsTo(JenisSampah::class, 'jenis_sampah_id');
    }
}
