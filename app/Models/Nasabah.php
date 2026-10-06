<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = ['kode_nasabah', 'nama', 'alamat', 'no_hp', 'saldo'];

    public function setorans(): HasMany
    {
        return $this->hasMany(Setoran::class);
    }

    public function tariks(): HasMany
    {
        return $this->hasMany(Tarik::class);
    }
}
