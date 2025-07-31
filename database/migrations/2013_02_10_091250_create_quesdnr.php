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
        Schema::create('quesdnr', function (Blueprint $table) {
            $table->id();
            $table->string('kdcab')->nullable();
            $table->string('id_donor')->nullable();
            $table->string('nodonor')->nullable();
            $table->string('noaftp')->nullable();
            $table->string('tglperiksa')->nullable();
            $table->string('sehat')->nullable();
            $table->string('sakit')->nullable();
            $table->string('diabet')->nullable();
            $table->string('ginjal')->nullable();
            $table->string('radang')->nullable();
            $table->string('jantung')->nullable();
            $table->string('hemofilia')->nullable();
            $table->string('asma')->nullable();
            $table->string('tbc')->nullable();
            $table->string('kenjang')->nullable();
            $table->string('hiv')->nullable();
            $table->string('hepatitis')->nullable();
            $table->string('sifilis')->nullable();
            $table->string('malaria')->nullable();
            $table->string('luarngri')->nullable();
            $table->string('hasilpriksa')->nullable();
            $table->string('orglain')->nullable();
            $table->string('bln')->nullable();
            $table->string('hamil')->nullable();
            $table->string('mens')->nullable();

              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quesdnr');
    }
};
