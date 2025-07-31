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
        Schema::create('ktgrusakaftap', function (Blueprint $table) {
            $table->id();
            $table->string('notrans')->nullable();
            $table->string('nokntng')->nullable();
            $table->date('tgltrans')->nullable();
            $table->string('jml')->nullable();
            $table->string('ket')->nullable();
            $table->string('kdptgs')->nullable();
            $table->string('nolot')->nullable();
            $table->string('perk')->nullable();
            $table->string('merk')->nullable();
            $table->string('jnsktg')->nullable();
            $table->string('ukktg')->nullable();
            $table->string('xx')->nullable();
            $table->string('alasan_rusak')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ktgrusakaftap');
    }
};
