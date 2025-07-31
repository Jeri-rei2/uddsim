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
        Schema::create('permintaankntng', function (Blueprint $table) {
            $table->id();
            $table->string('nmbarang')->nullable();
            $table->string('noterima')->nullable();
            $table->string('nokntng')->nullable();
            $table->string('mrkkntng')->nullable();
            $table->string('jnskntng')->nullable();
            $table->string('typekntng')->nullable();
            $table->string('tglterima')->nullable();
            $table->string('ukuran')->nullable();
            $table->string('nolot')->nullable();
            $table->string('nat')->nullable();
            $table->string('sttskntng')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaankntng');
    }
};
