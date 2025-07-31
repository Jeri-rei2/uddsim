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
        Schema::create('mjnsdrh', function (Blueprint $table) {
            $table->id();
            $table->string('kdcab',3);
            $table->string('kdjnsdr', 255);
            $table->string('nmjnsdr', 255);
            $table->string('umurhari', 255);
            $table->string('nmln', 255);
            $table->string('kdptgs', 255);
            $table->string('kode', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabang');
    }
};
