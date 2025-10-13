<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentFailedReasonToBoatBookingsTable extends Migration
{
    public function up()
    {
        // Remove from booking table if it exists
        if (Schema::hasColumn('booking', 'payment_failed_reason')) {
            Schema::table('booking', function (Blueprint $table) {
                $table->dropColumn('payment_failed_reason');
            });
        }
        // Add to boat_bookings table if not exists
        if (!Schema::hasColumn('boat_bookings', 'payment_failed_reason')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->string('payment_failed_reason')->nullable()->after('payment_status');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('boat_bookings', 'payment_failed_reason')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->dropColumn('payment_failed_reason');
            });
        }
    }
} 