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
        Schema::create('borrowing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unsigned()->constrained('users')->onDelete('cascade');
            $table->string('barcode_reference');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('reason')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('notes')->nullable();
            $table->uuid('uuid')->unique()->nullable();
            $table->tinyInteger('status')->default(0)->comment('0=pending,1=accepted,2=cancelled,3=done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing');
    }
};
