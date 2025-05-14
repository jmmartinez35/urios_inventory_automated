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
            $table->string('username');
            $table->string('email')->unique()->charset('utf8');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('status');
            $table->tinyInteger('role_as')->default('0')->comment('0=user.1=admin');
            $table->tinyInteger('user_status')->default('0')->comment('0=granted.1=pending');
            $table->string('password');
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
