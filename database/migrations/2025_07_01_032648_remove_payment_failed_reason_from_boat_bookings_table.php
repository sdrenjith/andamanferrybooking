<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePaymentFailedReasonFromBoatBookingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('boat_bookings', 'payment_failed_reason')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->dropColumn('payment_failed_reason');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('boat_bookings', 'payment_failed_reason')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->string('payment_failed_reason')->nullable()->after('payment_status');
            });
        }
    }
}
