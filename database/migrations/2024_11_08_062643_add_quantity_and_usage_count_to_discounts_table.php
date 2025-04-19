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
        Schema::table('discounts', function (Blueprint $table) {
            $table->integer('quantity')->default(0)->after('end_date'); // Số lượng mã còn lại
            $table->integer('usage_count')->default(0)->after('quantity'); // Số lần đã sử dụng
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('discounts', function (Blueprint $table) {
            $table->dropColumn(['quantity', 'usage_count']);
        });
    }
};
