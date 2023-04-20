<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegisterAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('register_id');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('landmark');
            $table->string('address');
            $table->string('zipCode');
            $table->string('cityId')->nullable();
            $table->string('stateId')->nullable();
            $table->string('countryId')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('register_addresses', function ($table) {
            $table->foreign('register_id')->references('id')->on('registers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_addresses');
    }
}
