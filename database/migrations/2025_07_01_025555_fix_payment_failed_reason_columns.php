<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixPaymentFailedReasonColumns extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Remove from booking if exists
        if (Schema::hasColumn('booking', 'payment_failed_reason')) {
            Schema::table('booking', function (Blueprint $table) {
                $table->dropColumn('payment_failed_reason');
            });
        }
        // Add to boat_bookings if not exists
        if (!Schema::hasColumn('boat_bookings', 'payment_failed_reason')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->string('payment_failed_reason')->nullable()->after('payment_status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back to booking if needed
        if (!Schema::hasColumn('booking', 'payment_failed_reason')) {
            Schema::table('booking', function (Blueprint $table) {
                $table->string('payment_failed_reason')->nullable()->after('payment_status');
            });
        }
        // Remove from boat_bookings if exists
        if (Schema::hasColumn('boat_bookings', 'payment_failed_reason')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->dropColumn('payment_failed_reason');
            });
        }
    }
}
