<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('affiliate_id');
            $table->integer('keyword_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('my_keywords', function ($table) {
            $table->foreign('affiliate_id')->references('id')->on('affiliates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_keywords');
    }
}
