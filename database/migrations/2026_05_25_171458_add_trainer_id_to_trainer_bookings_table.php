<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('trainer_bookings', function (Blueprint $table) {
            $table->foreignId('trainer_id')
                ->nullable()
                ->after('user_id')
                ->constrained('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('trainer_bookings', function (Blueprint $table) {
            $table->dropForeign(['trainer_id']);
            $table->dropColumn('trainer_id');
        });
    }
};
