<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('theme')->default(1)->comment('Theme No');
            $table->string('color');
            $table->string('domain')->nullable();
            $table->string('charge')->nullable()->comment('Admin take charge in percentage');
            $table->string('type')->nullable()->default(1)->comment('1-E-Commerce,2-Hybrid,3-Inquiry');
            $table->unsignedInteger('defaultCurrency');
            $table->string('logo');
            $table->string('title');
            $table->string('phone');
            $table->string('whatsApp')->nullable();
            $table->string('email');
            $table->string('address');
            $table->integer('pinCode');
            $table->string('password');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('accounts', function ($table) {
            $table->foreign('defaultCurrency')->references('id')->on('currencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
