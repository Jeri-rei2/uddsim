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
        Schema::create('aftpTrnsDnr', function (Blueprint $table) {
            $table->id();
            $table->string('kdcab',3)->nullable();
            $table->string('nodonor', 100)->nullable();
            $table->string('noaftap',100)->nullable();
            $table->date('tgldaftar')->nullable();
            $table->date('tglperiksa')->nullable();
            $table->date('tglhema')->nullable();
            $table->string('tglaftap',100)->nullable();
            $table->string('namadonor',100)->nullable();
            $table->string('goldar',100)->nullable();
            $table->string('rhesus',100)->nullable();
            $table->date('tgllahir',100)->nullable();
            $table->string('umur',100)->nullable();
            $table->string('kelompokumur',100)->nullable();
            $table->string('nokntng',100)->nullable();
            $table->string('hitung',100)->nullable();
            $table->string('almsrt',250)->nullable();
            $table->string('wil',250)->nullable();
            $table->string('jnsdnr',100)->nullable();
            $table->string('nofpup',100)->nullable();
            $table->string('namaos',100)->nullable();
            $table->string('nmcab',100)->nullable();
            $table->string('kdptghb',100)->nullable();
            $table->string('nmhb',100)->nullable();
            $table->string('kdptglab',100)->nullable();
            $table->string('nmptglab',100)->nullable();
            $table->string('kdptgdr',100)->nullable();
            $table->string('nmptgdr',100)->nullable();
            $table->string('kdptgsaftp',100)->nullable();
            $table->string('ptgsaftp',100)->nullable();
            $table->string('tensi',100)->nullable();
            // $table->string('TENSI2',100)->nullable();
            $table->string('nadi',100)->nullable();
            $table->string('brtbdn',100)->nullable();
            $table->string('kelompokbrat',100)->nullable();
            $table->string('suhu',100)->nullable();
            $table->string('ecg',100)->nullable();
            $table->string('tolak',100)->nullable();
            $table->string('alsntlk',100)->nullable();
            $table->string('ccamb',100)->nullable();
            $table->string('jnsktg',100)->nullable();
            $table->string('ketperiksa',100)->nullable();
            $table->string('metodehb',100)->nullable();
            $table->string('hasilhb',100)->nullable();
            $table->string('trombosit',100)->nullable();
            $table->string('ht',100)->nullable();
            $table->string('leokosit',100)->nullable();
            $table->string('eritrosit',100)->nullable();
            $table->string('ccstop',100)->nullable();
            $table->string('reaksiambil',100)->nullable();
            $table->string('reaksidnr',100)->nullable();
            $table->string('reaksilain',100)->nullable();
            $table->string('surat',100)->nullable();
            $table->string('puasa',100)->nullable();
            $table->string('waktu',100)->nullable();
            $table->string('ktgpenuh',100)->nullable();
            $table->string('disinfeksi',100)->nullable();
            $table->string('penggoyangan',100)->nullable();
            $table->string('sampledrh',100)->nullable();
            $table->string('penyerutan',100)->nullable();
            $table->string('sealer',100)->nullable();
            $table->string('catatan',100)->nullable();
            $table->string('ktgdarah',100)->nullable();
            $table->string('donorke',100)->nullable();
            $table->string('durasi',100)->nullable();

            // $table->string('statctk',100)->nullable();
            $table->string('status',100)->nullable();
            // $table->string('StatPeriksa',100)->nullable();
            // $table->string('StatHema',100)->nullable();
            // $table->string('StatKirim',100)->nullable();
            // $table->string('CKDPTGS',100)->nullable();
            // $table->datetime('tglsimpan')->nullable();
            // $table->string('kode',100)->nullable();
            // $table->string('Cek',100)->nullable();
            // $table->string('Bulan',100)->nullable();
            // $table->string('Tahun',100)->nullable();
            // $table->string('perkiraan',100)->nullable();
            // $table->string('UploadStamp',100)->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aftpTrnsDnr');
    }
};
