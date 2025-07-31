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
        Schema::create('aftpFpdrhH', function (Blueprint $table) {
            $table->id();
            // $table->string('CKDCAB')->nullable();
            $table->string('nofpd')->nullable();
            $table->string('tglfpd')->nullable();
            $table->string('total')->nullable();
            $table->string('stok')->nullable();
            $table->string('ket')->nullable();
            $table->string('xx')->nullable();
            $table->string('ckdptgs')->nullable();
            $table->string('type')->nullable();
            $table->string('rcn')->nullable();
            $table->string('suhu')->nullable();
            $table->string('nat')->nullable();
            $table->string('proseskirim')->nullable();
            $table->string('id_logger')->nullable();
            $table->string('id_coolbox')->nullable();
            $table->string('ckdptgsperiksa')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aftpFpdrhH');
    }
};
