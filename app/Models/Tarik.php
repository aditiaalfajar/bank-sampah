<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarik extends Model
{
    use HasFactory;

    protected $fillable = ['nasabah_id', 'tanggal', 'jumlah', 'keterangan'];

    public function nasabah(): BelongsTo
    {
        return $this->belongsTo(Nasabah::class);
    }
}
