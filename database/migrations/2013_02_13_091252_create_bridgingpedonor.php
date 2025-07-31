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
        Schema::create('bridgingpdonor', function (Blueprint $table) {
            $table->id();
            $table->string('kelompokumur')->nullable();
            $table->string('batasbawah')->nullable();
            $table->string('batasatas')->nullable();
             $table->string('nostock')->nullable();
             $table->string('nodonor')->nullable();
             $table->string('nokantong')->nullable();
             $table->string('namadonor')->nullable();
             $table->string('tgllahir')->nullable();
             $table->string('agama')->nullable();
             $table->string('jnskelamin')->nullable();
             $table->string('noktp')->nullable();
             $table->string('nosim')->nullable();
             $table->string('alamat1')->nullable();
             $table->string('alamat2')->nullable();
             $table->string('notlp')->nullable();
             $table->string('kodepos')->nullable();
             $table->string('kdwilayah')->nullable();
             $table->string('nmwilayah')->nullable();
             $table->string('kdkecamatan')->nullable();
             $table->string('nmkecamatan')->nullable();
             $table->string('kdnegara')->nullable();
             $table->string('kdpkrj')->nullable();
             $table->string('nmpkrj')->nullable();
             $table->string('goldarah')->nullable();
             $table->string('rhesus')->nullable();
             $table->string('golrh')->nullable();
             $table->string('gollain')->nullable();
             $table->string('donorke')->nullable();
             $table->string('tglakhdonor')->nullable();
             $table->string('tempatakhdonor')->nullable();
             $table->string('phargaan')->nullable();
             $table->string('cekal')->nullable();
             $table->string('jeniscekal')->nullable();
             $table->string('tglcekal')->nullable();
             $table->string('nocekal')->nullable();
             $table->string('puasa')->nullable();
             $table->string('waktu')->nullable();
             $table->string('surat')->nullable();
             $table->string('almsurat1')->nullable();
             $table->string('almsurat2')->nullable();
             $table->string('ckdptgs')->nullable();
             $table->string('notelprumah')->nullable();
             $table->string('notelpkantor')->nullable();
             $table->string('scab')->nullable();
             $table->string('scabket')->nullable();
             $table->string('jnsakhirdonor')->nullable();
             $table->string('carasadapakhir')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bridgingpdonor');
    }
};
