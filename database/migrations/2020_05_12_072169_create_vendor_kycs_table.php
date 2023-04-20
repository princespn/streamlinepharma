<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorKycsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_kycs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->string('companyName');
            $table->tinyInteger('companyType')->default(1)->comment('1-Limited Company,2-Private Limited Company,3-Partnership Firm,4-Proprietorship,5-LLP');
            $table->text('kycAddress');
            $table->text('kycAddressProof');
            $table->text('tanNumber');
            $table->text('tanImage');
            $table->text('accountHolderName');
            $table->text('accountNumber');
            $table->text('ifscCode');
            $table->text('bankName');
            $table->text('bankAddress');
            $table->text('bankProofName');
            $table->text('bankProofImage');
            $table->text('blankCheck');
            $table->text('blankCheckImage');
            $table->tinyInteger('kycStatus')->default(0)->comment('0-Pending,1-Approved,2-Refused');
            $table->tinyInteger('status')->default(1)->comment('1-Active,0-Inactive');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('vendor_kycs', function ($table) {
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
        Schema::dropIfExists('vendor_kycs');
    }
}
