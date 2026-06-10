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
 Schema::create('equipment_reports', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('equipment_name');
    $table->text('description');
    $table->string('status')->default('pending'); // pending, fixed, etc.
    $table->timestamps();
    
});
}

protected $dates = ['created_at', 'updated_at'];
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_reports');
    }
};