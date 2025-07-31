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
        Schema::create('mkantongjnstype', function (Blueprint $table) {
            $table->id();
            $table->string('typektg')->nullable();
            // $table->string('batasbawah')->nullable();
            $table->string('jenis')->nullable();
            $table->string('namatype')->nullable();
            $table->string('ukkantong')->nullable();
            $table->string('satelit')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mkantongjnstype');
    }
};
