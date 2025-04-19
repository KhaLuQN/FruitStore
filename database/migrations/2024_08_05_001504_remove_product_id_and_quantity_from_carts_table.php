<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveProductIdAndQuantityFromCartsTable extends Migration
{
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Xóa khóa ngoại trước khi xóa cột
            $table->dropForeign(['product_id']);
            $table->dropColumn('product_id');
            $table->dropColumn('quantity');
        });
    }

    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->bigInteger('product_id')->unsigned()->notNull();
            $table->integer('quantity')->notNull()->default(1);

            // Thêm lại khóa ngoại nếu rollback
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
}
