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
        Schema::create('detailpengeluaranktgaftp', function (Blueprint $table) {
            $table->id();
            $table->string('nopengeluaran', 150)->nullable();
            $table->string('merk',150)->nullable();
            $table->string('ukktg',150)->nullable();
            $table->string('jnsktg',150)->nullable();
            $table->string('noktg',50)->nullable();
            $table->string('status',150)->nullable();
            $table->integer('jml_ktg')->length(5)->unsigned();
            $table->string('type_stok',150)->nullable();
            $table->string('stokaftap',150)->nullable();
            $table->string('realstokaftap',150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailpengeluaranktgaftp');
    }
};
