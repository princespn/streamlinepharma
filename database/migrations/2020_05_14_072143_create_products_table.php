<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->integer('category_id1');
            $table->integer('category_id2')->nullable();
            $table->integer('category_id3')->nullable();
            $table->string('name');
            $table->text('description');
            $table->tinyInteger('qc')->default(0)->comment('0-Note Send,1-Send To QC,2-QC Reviewed,3-Qc MSG,4-QC Approved');
            $table->tinyInteger('status')->default(0)->comment('1-Active,0-Inactive,2-Send To QC,3-QC Reviewed');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('products', function ($table) {
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
        Schema::dropIfExists('products');
    }
}
