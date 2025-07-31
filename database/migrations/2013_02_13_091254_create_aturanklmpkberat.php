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
        Schema::create('aturanklmpkberat', function (Blueprint $table) {
            $table->id();
            $table->string('kelompokbrat')->nullable();
            $table->string('batasbawah')->nullable();
            $table->string('batasatas')->nullable();
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturanklmpkberat');
    }
};
