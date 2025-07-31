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
        Schema::create('pengeluaranktgaftp', function (Blueprint $table) {
            $table->id();
            $table->string('nopengeluaran',150)->nullable();
            $table->date('tglpengeluaran')->nullable();
            $table->string('ckdptgs',150)->nullable();
            $table->string('kdasldrh',150)->nullable();
            $table->string('kdmobil',150)->nullable();
            $table->string('kodenotebook',150)->nullable();
            $table->string('petugas',150)->nullable();
            $table->string('uploadstamp',150)->nullable();
         

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaranktgaftp');
    }
};
