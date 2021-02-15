<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->unsignedBigInteger('paymentcontrol_id');
            $table->foreign('paymentcontrol_id')->references('id')->on('paymentcontrols');
            $table->integer('payform');
            $table->string('day');
            $table->string('hours');
            $table->string('local');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
