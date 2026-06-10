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
    Schema::create('fitness_trainer_bookings', function (Blueprint $table) {
        $table->id();
  $table->foreignId('trainer_id')->constrained('users')->onDelete('cascade');
        $table->string('trainer_name');
        $table->date('booking_date');
        $table->string('activity');
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fitness_trainer_bookings');
    }
};
