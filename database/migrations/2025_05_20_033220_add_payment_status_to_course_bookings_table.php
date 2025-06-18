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
        Schema::table('course_bookings', function (Blueprint $table) {
            //
            $table->string('payment_status')->nullable();
            $table->string('transfer_slip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('course_bookings', function (Blueprint $table) {
            //
            $table->dropColumn('payment_status');
            $table->dropColumn('transfer_slip');
        });
    }
};
