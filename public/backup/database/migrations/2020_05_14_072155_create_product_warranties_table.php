<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductWarrantiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_warranties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inventoryId');
            $table->tinyInteger('domestic')->default(1)->comment('Domestic Warranty :- 1-Yes,0-No');
            $table->tinyInteger('international')->default(1)->comment('International Warranty :- 1-Yes,0-No');
            $table->string('summary')->comment('Warranty Summary')->nullable();
            $table->string('coveredIn')->comment('Covered in warranty')->nullable();
            $table->string('notCovered')->comment('Not covered warranty')->nullable();
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('product_warranties', function ($table) {
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
        Schema::dropIfExists('product_warranties');
    }
}
