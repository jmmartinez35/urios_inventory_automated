<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Add new columns to existing table
        Schema::table('borrowing_return', function (Blueprint $table) {
            $table->timestamp('returned_at')->nullable()->after('borrowing_id');
            $table->text('notes')->nullable()->after('returned_at');
        });

        // Step 2: Convert the existing integer column to foreign key
        DB::statement('ALTER TABLE borrowing_return MODIFY borrowing_id BIGINT UNSIGNED');

        // Step 3: Add the foreign key constraint
        Schema::table('borrowing_return', function (Blueprint $table) {
            $table->foreign('borrowing_id')
                  ->references('id')
                  ->on('borrowing')
                  ->cascadeOnDelete();
        });

        // Step 4: Add unique constraint if needed
        Schema::table('borrowing_return', function (Blueprint $table) {
            $table->unique('barcode_return');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('borrowing_return', function (Blueprint $table) {
            // Remove foreign key constraint
            $table->dropForeign(['borrowing_id']);
            
            // Convert back to integer
            DB::statement('ALTER TABLE borrowing_return MODIFY borrowing_id INT');
            
            // Drop added columns
            $table->dropColumn(['returned_at', 'notes']);
            
            // Remove unique constraint if added
            $table->dropUnique(['barcode_return']);
        });
    }
};