<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('access_level')->default('0');
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('rg')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('email');
            $table->string('website')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
        });

        Schema::create('packagenames', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->dateTime('created_at');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('created_at');
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('packagename_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('packagename_id')->references('id')->on('packagenames');
            $table->foreign('product_id')->references('id')->on('products');
            $table->float('price');
            $table->dateTime('created_at');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('package_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('package_id')->references('id')->on('packages');
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

        Schema::create('paymentforms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services');
            $table->integer('portion');
            $table->dateTime('date_pay');
            $table->dateTime('created_at');
        });

        Schema::create('paymentcontrols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paymentform_id');
            $table->foreign('paymentform_id')->references('id')->on('paymentforms');
            $table->integer('portion');
            $table->dateTime('date_pay');
            $table->float('value_pay');
            $table->dateTime('created_at');
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('service_id')->references('id')->on('services');
            $table->string('name');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('products');
        Schema::dropIfExists('packagenames');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('services');
        Schema::dropIfExists('paymentforms');
        Schema::dropIfExists('paymentcontrols');
        Schema::dropIfExists('photos');
    }
}
