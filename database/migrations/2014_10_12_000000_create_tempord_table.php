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
        Schema::create('tempord', function (Blueprint $table) {
            $table->id();
            $table->string('notrans'); 
            $table->string('tglminta')->nullable(); 
            $table->string('merk')->nullable(); 
            $table->string('ukktg')->nullable(); 
            $table->string('jnsktg')->nullable(); 
            $table->string('jumlah')->nullable(); 
            $table->string('nogd')->nullable(); 
            $table->string('dipenuhi')->nullable(); 
            $table->string('ket')->nullable();
            $table->string('stok')->nullable();
            $table->string('type')->nullable();
            $table->string('tujuan_dept')->nullable(); 


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempord');
    }
};
