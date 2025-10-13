<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('phonepe_payment_details', function (Blueprint $table) {
            $table->json('metadata')->nullable()->after('response_data');
        });
    }
    public function down(): void {
        Schema::table('phonepe_payment_details', function (Blueprint $table) {
            $table->dropColumn('metadata');
        });
    }
};

