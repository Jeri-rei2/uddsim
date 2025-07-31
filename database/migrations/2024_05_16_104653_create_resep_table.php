<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resep', function (Blueprint $table) {
            $table->id();
            $table->string('dokter');
            $table->date('tglresep');
            $table->string('obat');
            $table->string('kode_brng');
            $table->string('pasien');
            $table->biginteger('pesanan_id')->unsigned();
            $table->integer('user_id')->length(11)->unsigned();
            $table->string('jumlah');
            $table->string('aturanpakai');
            $table->text('keterangan');
            $table->string('total_harga');
            $table->string('snap_token');
            $table->string('status_bayar');
            $table->string('ttd');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};
