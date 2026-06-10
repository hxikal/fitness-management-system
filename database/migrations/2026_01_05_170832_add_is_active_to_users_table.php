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
        if (!Schema::hasColumn('users', 'is_active')) {
            $table->boolean('is_active')->default(1)->after('password');
        }
        if (!Schema::hasColumn('users', 'no_telefon')) {
            $table->string('no_telefon')->nullable()->after('email');
        }
        if (!Schema::hasColumn('users', 'role')) {
            $table->string('role')->default('user')->after('email');
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Membuang kolom jika migration di-rollback
            $table->dropColumn('is_active');
        });
    }
};