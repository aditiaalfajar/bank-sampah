<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisSampah extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'harga_per_kg', 'satuan', 'keterangan'];

    public function setorans(): HasMany
    {
        return $this->hasMany(Setoran::class);
    }
}
