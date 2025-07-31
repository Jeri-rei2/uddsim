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
        Schema::create('bridgingpengiriman', function (Blueprint $table) {
            $table->id();
            $table->string('merk')->nullable();
            $table->string('kdcab')->nullable();
            $table->string('kdbd')->nullable();
            $table->string('urut')->nullable();
            $table->string('notrans')->nullable();
            $table->string('tgltans')->nullable();
            $table->string('nostok')->nullable();
            $table->string('jnsdarah')->nullable();
            $table->string('goldarah')->nullable();
            $table->string('rrhesus')->nullable();
            $table->string('tglexp')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('nokantong')->nullable();
            $table->string('tglaftap')->nullable();
            $table->string('asaldarah')->nullable();
            $table->string('nopilih')->nullable();
            $table->string('nodonor')->nullable();
            $table->string('nofpd')->nullable();
            $table->string('jnsdonor')->nullable();
            $table->string('nows')->nullable();
            $table->string('noaftap')->nullable();
            $table->string('jnskantong')->nullable();
            $table->string('nilai')->nullable();
            $table->string('statusstock')->nullable();
            $table->string('alasan')->nullable();
            $table->string('xx')->nullable();
            $table->string('ckdptgs')->nullable();
            $table->string('nokeluar')->nullable();
            $table->string('tglkeluar')->nullable();
            $table->string('perk')->nullable();
            $table->string('perkiraan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bridgingpengiriman');
    }
};
