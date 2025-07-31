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
        Schema::create('pengembalianktgmu', function (Blueprint $table) {
            $table->id();
            $table->string('nokembali',150)->nullable();
            $table->string('noktg',150)->nullable();
            $table->string('merk',150)->nullable();
            $table->string('ukktg',150)->nullable();
            $table->string('jnsktg',150)->nullable();
            $table->string('status',150)->nullable();
            $table->date('tglkembali');
            $table->string('type_stok',150)->nullable();
            $table->string('stokaftap',150)->nullable();
            $table->string('jml_kembali',150)->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalianktgmu');
    }
};
