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
        Schema::create('permintaan', function (Blueprint $table) {
            $table->id();
            $table->string('nmbarang')->nullable();
            $table->string('nopengiriman')->nullable();
            $table->string('idpengiriman')->nullable();
            $table->string('tglminta')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('nostok')->nullable();
            $table->string('nokantong')->nullable();
            $table->string('jnsdarah')->nullable();
            $table->string('gol')->nullable();
            $table->string('rhesus')->nullable();
            $table->string('tglaftap')->nullable();
            $table->string('tglexp')->nullable();

              
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan');
    }
};
