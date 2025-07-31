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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kdbrg',10);
            $table->string('nmbrg', 100);
            $table->char('brdreagen',0);
            $table->string('satuanbsr', 100);
            $table->string('satuankcl', 100);
            $table->biginteger('hrsat')->unsigned();
            $table->integer('stok')->length(50)->unsigned();
            $table->integer('stokmin')->length(50)->unsigned();
            $table->integer('stokawal')->length(50)->unsigned();
            $table->string('jnsbrg', 100);
            $table->integer('stoktambah')->length(50)->unsigned();
            $table->string('ukuran', 25);
            $table->string('jnskantong', 25);
            $table->integer('kodekelompok')->length(50)->unsigned();
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
