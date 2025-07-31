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
        Schema::create('priksadonor', function (Blueprint $table) {
            $table->id();
            $table->string('kdcab',3)->nullable();
            $table->string('noaftap', 255)->nullable();
            $table->datetime('tgldaftar' )->nullable();
            $table->datetime('tglperiksa')->nullable();
            $table->datetime('tglhema' )->nullable();
            $table->datetime('tglaftap' )->nullable();
            $table->string('nodonor', 255)->nullable();
            $table->string('namadonor', 255)->nullable();
            $table->string('goldar', 255)->nullable();
            $table->string('rhesus', 255)->nullable();
            $table->date('tgllahir')->nullable();
            $table->string('umur', 25)->nullable();
            $table->string('kelompokumur', 25)->nullable();
            $table->string('almsrt1', 255)->nullable();
            $table->string('almsrt2', 255)->nullable();
            $table->string('jnsdonor', 50)->nullable();
            $table->string('nofpup', 80)->nullable();
            $table->string('namaos', 150)->nullable();
            $table->string('ckdasldrh', 6)->nullable();
            $table->string('asaldrh', 255)->nullable();
            $table->string('kdptghb', 255)->nullable();
            $table->string('nmptghb', 255)->nullable();
            $table->string('kdptglab', 255)->nullable();
            $table->string('nmptglab', 255)->nullable();
            $table->string('kdptgdr', 255)->nullable();
            $table->string('nmptgdr', 255)->nullable();
            $table->string('kdptgaftp', 255)->nullable();
            $table->string('nmptgaftp', 255)->nullable();
            $table->string('tensi', 255)->nullable();
            $table->string('nadi', 255)->nullable();
            $table->string('brtbdn', 255)->nullable();
            $table->string('klmpkbrt', 255)->nullable();
            $table->string('suhu', 255)->nullable();
            $table->string('ecg', 255)->nullable();
            $table->string('tolak', 255)->nullable();
            $table->string('alsntlk', 255)->nullable();
            $table->string('ccambil', 255)->nullable();
            $table->string('jnsktg', 255)->nullable();
            $table->string('ketpriksa', 255)->nullable();
            $table->string('metodehb', 255)->nullable();
            $table->string('hasilhb', 255)->nullable();
            $table->string('trombosit', 50)->nullable();
            $table->string('ht', 50)->nullable();
            $table->string('leokosit', 50)->nullable();
            $table->string('eritrosit', 50)->nullable();
            $table->string('ccstop', 150)->nullable();
            $table->string('reakambil', 50)->nullable();
            $table->string('reakdonor', 50)->nullable();
            $table->string('reaklain', 50)->nullable();
            $table->string('surat', 255)->nullable();
            $table->string('puasa', 50)->nullable();
            $table->string('waktu', 50)->nullable();
            $table->string('ktgpenuh', 50)->nullable();
            $table->string('disinfeksi', 150)->nullable();
            $table->string('penggoyangan', 150)->nullable();
            $table->string('sampel', 255)->nullable();
            $table->string('penyerut', 255)->nullable();
            $table->string('sealer', 255)->nullable();
            $table->string('catatan', 255)->nullable();
            $table->string('ktgdarah', 255)->nullable();
            $table->string('donorke', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->string('statperiksa', 255)->nullable();
            $table->string('stathema', 255)->nullable();
            $table->string('statkirim', 255)->nullable();
            $table->string('ckdptgs', 255)->nullable();
            $table->string('kode', 255)->nullable();
            $table->string('cekblntglthn', 255)->nullable();
            $table->string('bulan', 255)->nullable();
            $table->string('thn', 255)->nullable();
            $table->string('perkiraan', 255)->nullable();
            $table->string('uploadstamp', 250)->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priksadonor');
    }
};
