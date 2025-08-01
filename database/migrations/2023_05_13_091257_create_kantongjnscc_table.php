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
        Schema::create('kantongjnscc', function (Blueprint $table) {
            $table->id();
            $table->string('jenisktg', 50);
            $table->string('ukuran', 10);
            $table->string('Keterangan', 255);
            $table->integer('satelit')->length(50)->unsigned();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kantongjnscc');
    }
};
