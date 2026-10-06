<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nasabahs', function (Blueprint $table) {
            $table->id();
            $table->string('kode_nasabah')->unique();
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->decimal('saldo', 15, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('jenis_sampahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('harga_per_kg')->default(0);
            $table->string('satuan')->default('kg');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('setorans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained()->cascadeOnDelete();
            $table->foreignId('jenis_sampah_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->decimal('berat_kg', 10, 2);
            $table->integer('harga_total');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('tariks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nasabah_id')->constrained()->cascadeOnDelete();
            $table->date('tanggal');
            $table->integer('jumlah');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tariks');
        Schema::dropIfExists('setorans');
        Schema::dropIfExists('jenis_sampahs');
        Schema::dropIfExists('nasabahs');
    }
};
