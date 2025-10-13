<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRazorpayOrderIdToBoatBookingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('boat_bookings', 'razorpay_order_id')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->string('razorpay_order_id')->nullable()->after('order_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('boat_bookings', 'razorpay_order_id')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->dropColumn('razorpay_order_id');
            });
        }
    }
}
