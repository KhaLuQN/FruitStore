<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->string('receiver_name')->nullable()->after('user_id');
            $table->string('receiver_phone')->nullable()->after('receiver_name');
            $table->string('receiver_address')->nullable()->after('receiver_phone');
            $table->decimal('discount', 5, 2)->default(0)->after('total');
            $table->text('notes')->nullable()->after('discount');


            $table->enum('status', ['unpaid', 'paid', 'cancelled'])->default('unpaid')->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['receiver_name', 'receiver_phone', 'receiver_address', 'discount', 'notes']);
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending')->change();
        });
    }
}
