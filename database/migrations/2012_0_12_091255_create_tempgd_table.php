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
        Schema::create('tempgd', function (Blueprint $table) {
            $table->id();
            $table->string('nokntng'); 
            $table->string('nmkntng')->nullable(); 
            $table->json('data')->nullable(); 
            // $table->string('barcode')->nullable(); 
            $table->text('barcode')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempgd');
    }
};
