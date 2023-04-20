<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_services', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->tinyInteger('delivery')->default(1)->comment('1-Active,0-Inactive');
            $table->string('deliveryTitle');
            $table->tinyInteger('moneyBack')->default(1)->comment('1-Active,0-Inactive');
            $table->string('moneyBackTitle');
            $table->tinyInteger('support')->default(1)->comment('1-Active,0-Inactive');
            $table->string('supportTitle');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('abouts', function ($table) {
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
        Schema::dropIfExists('extra_services');
    }
}
