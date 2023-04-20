<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->integer('defaultSelection')->default(1)->comment('1-Default Selected,0-Not Default Selected');
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
            $table->tinyInteger('isIdle')->default(0)->comment('1-Active,0-Inactive');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('product_inventories', function ($table) {
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_inventories');
    }
}
