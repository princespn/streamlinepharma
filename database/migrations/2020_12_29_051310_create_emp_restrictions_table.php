<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpRestrictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emp_restrictions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->unsignedInteger('action_id');
            $table->unsignedInteger('page_id');
            $table->softDeletes();
            $table->timestamps();;
        });
        Schema::table('emp_restrictions', function ($table) {
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('action_id')->references('id')->on('actions');
            $table->foreign('page_id')->references('id')->on('pages');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emp_restrictions');
    }
}
