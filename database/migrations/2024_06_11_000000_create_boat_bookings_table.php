<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boat_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('boat');
            $table->date('travel_date');
            $table->integer('no_of_passengers');
            $table->integer('infants')->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boat_bookings');
    }
}; 