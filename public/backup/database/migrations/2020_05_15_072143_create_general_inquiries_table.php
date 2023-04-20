<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_inquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->string('title');
            $table->string('description');
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('general_inquiries', function ($table) {
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
        Schema::dropIfExists('general_inquiries');
    }
}
