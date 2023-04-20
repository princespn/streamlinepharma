<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPackagingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_packagings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inventoryId');
            $table->float('weight')->comment('kg');
            $table->float('length')->comment('cm');
            $table->float('width')->comment('cm');
            $table->float('height')->comment('cm');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('product_packagings', function ($table) {
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
        Schema::dropIfExists('product_packagings');
    }
}
