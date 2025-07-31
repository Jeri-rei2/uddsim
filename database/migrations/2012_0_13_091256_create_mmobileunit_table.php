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
        Schema::create('mmobileunit', function (Blueprint $table) {
            $table->id();
            $table->string('kdcab',3)->nullable();
            $table->string('kdmobil', 255)->nullable();
            $table->string('merek', 150)->nullable();
            $table->string('plat',50)->nullable();
            $table->string('thprod',50)->nullable();
            $table->string('thbeli',50)->nullable();
            $table->string('kdptgs', 50)->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mmobileunit');
    }
};
