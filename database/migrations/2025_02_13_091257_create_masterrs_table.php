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
        Schema::create('masterrs', function (Blueprint $table) {
            $table->id();
            $table->string('kdcab',3);
            $table->string('kdrs',255);
            $table->string('jnsrs',255);
            $table->string('klsrs', 255);
            $table->string('almt1',255);
            $table->string('almt2',255);
            $table->string('tlp',255);
            $table->string('kdpos',255);
            $table->string('kdptgs',255);
            $table->string('nmjnsbiaya',255);
            $table->string('kdcat',255);
            $table->string('bankdarah',255);
            $table->string('kdwil',255);
            $table->string('tanda_biaya',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pekerjaan');
    }
};
