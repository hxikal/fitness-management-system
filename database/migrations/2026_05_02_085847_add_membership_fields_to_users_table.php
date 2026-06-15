<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('users', function (Blueprint $table) {
        if (!Schema::hasColumn('users', 'membership_start')) {
            $table->dateTime('membership_start')->nullable();
        }
        if (!Schema::hasColumn('users', 'membership_expiry')) {
            $table->dateTime('membership_expiry')->nullable();
        }
        if (!Schema::hasColumn('users', 'is_active')) {
            $table->boolean('is_active')->default(0);
        }
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['membership_start', 'membership_expiry', 'is_active']);
    });
}

};
