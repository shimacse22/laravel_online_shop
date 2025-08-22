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
        //
        Schema::table('product_images', function (Blueprint $table) {
           

            // Modify an existing column (if needed)
            $table->boolean('is_primary')->default(false); // Whether this is the primary image
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('product_images', function (Blueprint $table) {
            // Rollback changes in the down method
            $table->dropColumn('is_primary'); // Remove the is_primary column
           
        });
       
    }
};
