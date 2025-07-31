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
        Schema::create('LBstGolDarahH', function (Blueprint $table) {
            $table->id();
            $table->string('Noperiksa')->nullable();
        $table->datetime('Tglperiksa')->nullable();
        $table->string('ckdptgs')->nullable();
        $table->string('perk')->nullable();
        $table->string('status')->nullable();
        $table->datetime('lastupdate')->nullable();
        $table->string('kdcab')->nullable();


            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('LBstGolDarahH');
    }
};
