<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->tinyInteger('affiliate_id')->nullable();
            $table->tinyInteger('qty');
            $table->float('price');
            $table->tinyInteger('tax')->nullable();
            $table->float('shipping');
            $table->tinyInteger('inventory_id');
            $table->string('sku')->nullable();
            $table->string('productName');
            $table->text('productDescription');
            $table->integer('variation0')->nullable();
            $table->integer('variation1')->nullable();
            $table->integer('variation2')->nullable();
            $table->integer('variation3')->nullable();
            $table->integer('variation4')->nullable();
            $table->text('imageURL0')->nullable();
            $table->text('imageURL1')->nullable();
            $table->text('imageURL2')->nullable();
            $table->text('imageURL3')->nullable();
            $table->text('imageURL4')->nullable();
            $table->text('imageURL5')->nullable();
            $table->text('videoURL')->nullable();
            $table->text('pdfURL')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('order_details', function ($table) {
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
