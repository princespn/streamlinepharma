<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImageUpload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imageUploads', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->integer('mediaType')->nullable();
            $table->integer('ref_id')->nullable();
            $table->string('name',150);
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('imageUploads', function ($table) {
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
        Schema::dropIfExists('imageUploads');
    }
}
