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
        if (!Schema::hasColumn('equipment_reports', 'equip_name')) {
            $table->string('equip_name')->after('user_id');
        }
        if (!Schema::hasColumn('equipment_reports', 'urgency')) {
            $table->string('urgency')->after('equip_name');
        }
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment_reports', function (Blueprint $table) {
            //
        });
    }
};
