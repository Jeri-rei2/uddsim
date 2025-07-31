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
        Schema::create('donor', function (Blueprint $table) {
            $table->id();
            $table->string('kdcab',3)->nullable();
            $table->string('nodonor', 100)->nullable();
            $table->string('noaftp', 100)->nullable();
            $table->string('namadonor', 255)->nullable();
            $table->date('tgllahir')->nullable();
            $table->date('tgldaftar')->nullable();
            $table->string('photo', 255)->nullable();
            $table->string('agama', 20)->nullable();
            $table->string('jk', 25)->nullable();
            $table->string('noktp', 25)->nullable();
            $table->string('nosim', 25)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('tlp', 15)->nullable();
            $table->string('kodepos', 25)->nullable();
            $table->string('kdwil', 3)->nullable();
            $table->string('nmwil', 255)->nullable();
            $table->string('kdkec', 3)->nullable();
            $table->string('kdneg', 3)->nullable();
            $table->string('nmneg', 255)->nullable();
            $table->string('nmpkrj', 255)->nullable();
            $table->string('goldar', 3)->nullable();
            $table->string('donorke', 10)->nullable();
            $table->string('mtdpeng', 255)->nullable();
            $table->string('usia', 255)->nullable();
            $table->string('kelurahan', 255)->nullable();
            $table->string('kecamatan', 255)->nullable();
            $table->boolean('stperiksa')->default(false);
       
           

           


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor');
    }
};
