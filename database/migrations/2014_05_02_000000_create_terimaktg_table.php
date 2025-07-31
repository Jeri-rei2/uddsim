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
        Schema::create('terimaktg', function (Blueprint $table) {
            $table->id();
            $table->string('nokntng'); 
            $table->string('notrans')->nullable(); 
            $table->string('nominta')->nullable(); 
            $table->string('jnskntng')->nullable(); 
            $table->string('ukuran')->nullable(); 
            $table->string('merkktg')->nullable(); 
            $table->string('jmlterima')->nullable(); 
            $table->string('jmlkirimgd')->nullable();  
            $table->string('status')->nullable(); 
            $table->date('tglterima');
            $table->string('type_stok')->nullable(); 
            $table->string('realpermintaan')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terimaktg');
    }
};
