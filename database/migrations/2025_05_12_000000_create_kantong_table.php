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
        Schema::create('kantong', function (Blueprint $table) {
            $table->id();
            $table->string('noterima');
            $table->string('nokntng');
            $table->string('mrkkntng');
            $table->string('jnskntng');
            $table->string('typekntng');
            $table->date('tglterima');
            $table->string('ukuran');
            $table->string('nolot');
            $table->string('nat');
            $table->string('sttskntng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kantong');
    }
};
