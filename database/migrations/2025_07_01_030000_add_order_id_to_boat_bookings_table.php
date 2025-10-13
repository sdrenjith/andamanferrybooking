<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdToBoatBookingsTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('boat_bookings', 'order_id')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->string('order_id')->nullable()->after('id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('boat_bookings', 'order_id')) {
            Schema::table('boat_bookings', function (Blueprint $table) {
                $table->dropColumn('order_id');
            });
        }
    }
} 