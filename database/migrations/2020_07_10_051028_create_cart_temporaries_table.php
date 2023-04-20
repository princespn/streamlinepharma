<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartTemporariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_temporaries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->text('register_id')->comment('user identify by session id');
            $table->tinyInteger('affiliate_id')->nullable()->comment('affiliation link product');
            $table->tinyInteger('inventoryId');
            $table->tinyInteger('qty')->default(1);
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('cart_temporaries', function ($table) {
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
        Schema::dropIfExists('cart_temporaries');
    }
}
