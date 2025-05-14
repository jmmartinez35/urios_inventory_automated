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
        Schema::create('borrowing_cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('borrowing_id')->unsigned()->constrained('borrowing')->onDelete('cascade');
            $table->foreignId('cart_id')->unsigned()->constrained('cart')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_cart');
    }
};
