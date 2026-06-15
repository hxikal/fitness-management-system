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
    Schema::create('trainer_sessions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('trainer_id');   // link ke trainer
        $table->string('trainer_name');             // nama trainer
        $table->date('session_date');               // tarikh
        $table->time('start_time');                 // masa mula
        $table->time('end_time');                   // masa akhir
        $table->string('activity');                 // aktiviti
        $table->string('status')->default('available'); // status slot
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_sessions');
    }
};
