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
        Schema::create('masldrh', function (Blueprint $table) {
            $table->id();
            $table->string('kdcab',3)->nullable();
            $table->string('asldrh',255)->nullable();
            $table->string('nmasldrh',255)->nullable();
            $table->string('kelompok',255)->nullable();
            $table->string('alm1',255)->nullable();
            $table->string('alm2',255)->nullable();
            $table->string('tlp',255)->nullable();
            $table->string('kdpos',255)->nullable();
            $table->string('nmpsr',255)->nullable();
            $table->string('tlppsr',255)->nullable();
            $table->string('kdptgs',255)->nullable();
            $table->string('uploadstamp',255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masldrh');
    }
};
