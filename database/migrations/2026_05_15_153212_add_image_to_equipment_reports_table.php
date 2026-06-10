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
   Schema::table('equipment_reports', function (Blueprint $table) {
    $table->string('image')->nullable(); // ✅ stores image path
});
}

public function down(): void
{
    Schema::table('equipment_reports', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
};
