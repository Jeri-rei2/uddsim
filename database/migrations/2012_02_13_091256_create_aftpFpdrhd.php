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
        Schema::create('aftpFpdrhd', function (Blueprint $table) {
            $table->id();
            $table->string('nofpd')->nullable();
            $table->string('tglfpd')->nullable();
            $table->string('urut')->nullable();
            $table->string('nokntng')->nullable();
            $table->string('jnskntng')->nullable();
            $table->string('noaftap')->nullable();
            $table->string('tglaftap')->nullable();
            $table->string('nodonor')->nullable();
            $table->string('namadonor')->nullable();
            $table->string('ckdasldrh')->nullable();
            $table->string('asldrh')->nullable();
            $table->string('goldar')->nullable();
            $table->string('rhesus')->nullable();
            $table->string('tolak')->nullable();
            $table->string('ket')->nullable();
            $table->string('status')->nullable();
            $table->string('tglsimpan')->nullable();
            $table->string('ckdptgs')->nullable();
            $table->string('kdcab')->nullable();
            $table->string('xx')->nullable();
            $table->string('perkiraan')->nullable();
            $table->string('jnsdonor')->nullable();
            $table->string('suhu')->nullable();
            $table->string('id_logger')->nullable();
            $table->string('id_coolbox')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aftpFpdrhd');
    }
};
