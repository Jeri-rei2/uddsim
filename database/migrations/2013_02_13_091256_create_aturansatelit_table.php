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
        Schema::create('aturansatelit', function (Blueprint $table) {
            $table->id();
            $table->string('kdtype',10);
            $table->string('typektg',10);
            $table->string('jnsdarah', 100);
            $table->string('satelit', 35);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aturansatelit');
    }
};
