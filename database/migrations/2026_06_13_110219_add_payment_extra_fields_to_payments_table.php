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
    Schema::table('payments', function (Blueprint $table) {
        $table->string('transaction_id')->nullable();
        $table->string('plan')->nullable();
        $table->string('method')->nullable();
        $table->string('receipt_path')->nullable();
    });
}

public function down(): void
{
    Schema::table('payments', function (Blueprint $table) {
        $table->dropColumn([
            'transaction_id',
            'plan',
            'method',
            'receipt_path'
        ]);
    });
}
};
