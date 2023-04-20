<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_reasons', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->tinyInteger('type')->default(0)->comment('1-Cancel,2-Return,3-Replacement');            
            $table->string('title');
            $table->tinyInteger('status')->default(0)->comment('1-Active,0-Inactive,2-Send To QC,3-QC Reviewed');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('user_reasons', function ($table) {
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
        Schema::dropIfExists('user_reasons');
    }
}
