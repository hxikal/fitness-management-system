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
    Schema::table('equipment_reports', function (Blueprint $table) {
        if (!Schema::hasColumn('equipment_reports', 'image')) {
            $table->string('image')->nullable();
        }
    });
}

public function down(): void
{
    Schema::table('equipment_reports', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
};
