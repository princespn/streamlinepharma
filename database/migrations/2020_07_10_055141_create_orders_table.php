<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->tinyInteger('register_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('landmark');
            $table->string('address');
            $table->string('zipCode');
            $table->tinyInteger('transactionType')->comment('1-COD,2-Online');
            $table->string('transactionId');
            $table->tinyInteger('orderNo');
            $table->tinyInteger('orderStatus')->default(1)->comment('1-Ordered,2-Packed,3-Shipped,4-Delivered,5-Cancel Before Delivery,6-Cancel After Delivery,7-Refunded');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('orders', function ($table) {
            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
