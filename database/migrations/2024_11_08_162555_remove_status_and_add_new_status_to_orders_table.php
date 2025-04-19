<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveStatusAndAddNewStatusToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Xóa cột status
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        // Thêm lại cột status với các giá trị mới
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'processing', 'out_for_delivery', 'completed', 'cancelled'])
                ->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Khôi phục lại cột status nếu rollback migration
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'processing', 'completed'])
                ->default('pending');
        });
    }
}
