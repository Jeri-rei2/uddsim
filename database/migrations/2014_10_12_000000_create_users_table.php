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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number');
            $table->string('nik');
            $table->string('alamat');
            $table->tinyInteger('type')->default(0);
            $table->string('picture')->default('default.png');
             $table->string('user_id');
              $table->string('role_id');
            /* Users: 0=>User, 1=>Admin, 2=>Manager */
            $table->string('token')->nullable();
            $table->string('department_id')->nullable();
            $table->string('bagian')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
