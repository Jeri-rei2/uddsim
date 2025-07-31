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
        Schema::create('ktgkirim', function (Blueprint $table) {
            $table->id();
            $table->string('notrans'); 
            $table->string('nopermintaan'); 
            $table->string('nokntng'); 
            $table->string('tgltrans')->nullable(); 
            $table->string('total')->nullable(); 
            $table->string('ket')->nullable(); 
            $table->string('kdptgs')->nullable(); 
            $table->string('perk')->nullable(); 
            $table->string('status')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktgkirim');
    }
};
