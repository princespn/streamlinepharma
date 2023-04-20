<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_media', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->string('facebook');
            $table->string('twitter')->nullable();
            $table->string('googleplus')->nullable();
            $table->string('instagram')->nullable();
            $table->string('pinterest')->nullable();
            $table->string('dribble')->nullable();
            $table->string('vimeo')->nullable();
            $table->string('youtube')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('social_media', function ($table) {
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
        Schema::dropIfExists('social_media');
    }
}
