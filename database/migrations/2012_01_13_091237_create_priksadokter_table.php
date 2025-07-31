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
        Schema::create('priksadokter', function (Blueprint $table) {
            $table->id();
            $table->string('kdcab',3)->nullable();
            $table->string('noaftap', 255)->nullable();
            $table->datetime('tgldaftar' )->nullable();
            $table->datetime('tglperiksa')->nullable();
            $table->datetime('tglhema' )->nullable();
            $table->datetime('tglaftap' )->nullable();
            $table->string('nodonor', 255)->nullable();
            $table->string('namadonor', 255)->nullable();
            $table->date('tgllahir')->nullable();
            $table->string('umur', 255)->nullable();
            $table->string('nokantong', 255)->nullable();
            $table->string('almt', 255)->nullable();
            $table->string('jnsdnr', 255)->nullable();
            $table->string('nofpup', 255)->nullable();
            $table->string('kdasldrh', 255)->nullable();
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
            $table->string('tgbdn', 255)->nullable();
            $table->string('klmpkbrt', 255)->nullable();
            $table->string('suhu', 255)->nullable();
            $table->string('ecg', 255)->nullable();
            $table->string('tolak', 255)->nullable();
            $table->string('alsntlk', 255)->nullable();
            $table->string('ccambil', 255)->nullable();
            $table->string('jnsktg', 255)->nullable();
            $table->string('typektg', 255)->nullable();
            $table->string('ketperiksa', 255)->nullable();
            $table->string('donorke', 255)->nullable();
            $table->string('status', 255)->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priksadokter');
    }
};
