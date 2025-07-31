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
        Schema::create('LBstGolDarahD', function (Blueprint $table) {
            $table->id();
            $table->string('Noperiksa')->nullable();
            $table->string('NoKantong')->nullable();
            $table->string('NoDonor')->nullable();
            $table->string('GolDarah')->nullable();
            $table->string('Rhesus')->nullable();
            $table->string('GolDarah_LB')->nullable();
            $table->string('Rhesus_LB')->nullable();
            $table->string('status')->nullable();
            $table->datetime('lastupdate')->nullable();
            $table->string('GolDarah_LIS')->nullable();
            $table->string('Rhesus_LIS')->nullable();
            $table->datetime('Tgl_LIS')->nullable();
            $table->string('Idx_LIS')->nullable();
            $table->string('Mesin_LIS')->nullable();
            $table->string('KDCab')->nullable();
            $table->string('AslDrh')->nullable();
            $table->string('flg')->nullable();
            $table->string('nourut')->nullable();

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('LBstGolDarahD');
    }
};
