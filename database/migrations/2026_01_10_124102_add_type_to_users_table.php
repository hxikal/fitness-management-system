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
        Schema::table('users', function (Blueprint $table) {
            // Adds the 'type' column. 
            // We use nullable() so existing users don't break, 
            // and default('walk-in') to give new users a starting value.
            //$table->string('type')->nullable()->default('walk-in')->after('role');
              $table->boolean('is_active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // This allows you to undo the migration if needed
            $table->dropColumn('type');
        });
    }
};