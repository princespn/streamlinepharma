<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAffiliationKeywordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_affiliation_keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inventoryId');
            $table->integer('keyword_id');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('product_affiliation_keywords', function ($table) {
            $table->foreign('inventoryId')->references('id')->on('product_inventories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_affiliation_keywords');
    }
}
