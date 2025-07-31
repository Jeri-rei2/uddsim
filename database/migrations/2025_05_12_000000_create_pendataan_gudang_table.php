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
        Schema::create('qrgudang', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); 
            $table->integer('nilai')->nullable();// barcode code
            $table->string('name')->nullable();
            $table->string('mrkkntng');
            $table->string('jnskntng');
            $table->string('typekntng');
            $table->date('tglbrcode');
            $table->string('ukuran');
            $table->string('jmlcetak');
            $table->string('duplikat');
            $table->string('nolot');
            $table->string('nat');
            $table->string('nokntng');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('qrgudang');
    }
};
