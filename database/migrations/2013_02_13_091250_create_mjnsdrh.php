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
        Schema::create('mjnsdrh', function (Blueprint $table) {
            $table->id();
            $table->string('nmbarang')->nullable();
            // $table->string('batasbawah')->nullable();
              $table->string('kdcab')->nullable();
              $table->string('kdjnsdr')->nullable();
              $table->string('nmjnsdr')->nullable();
              $table->string('umurhari')->nullable();
              $table->string('nmln')->nullable();
              $table->string('kdptgs')->nullable();
              $table->string('kode')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mjnsbarang');
    }
};
