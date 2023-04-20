<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingsTable extends Migration
{
    public function up()
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->string('heading');
            $table->text('description');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('shippings', function ($table) {
            $table->foreign('account_id')->references('id')->on('accounts');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('shippings');
    }
}
