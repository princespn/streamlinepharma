<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferNormalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_normals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->timestamp('startDate',0)->nullable();
            $table->timestamp('endDate',0)->nullable();
            $table->text('couponCode');
            $table->text('website_url_image');
            $table->text('mobile_url_image');
            $table->integer('cartMinValue')->comment('Cart Minimum Value');
            $table->integer('discount')->comment('Discount in %');
            $table->integer('noOfUsers')->comment('How many user can refer this offer');
            $table->text('link')->comment('Offer url for user');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('offer_normals', function ($table) {
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
        Schema::dropIfExists('offer_normals');
    }
}
