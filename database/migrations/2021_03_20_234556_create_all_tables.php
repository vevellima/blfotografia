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
            $table->string('cpf');
            $table->string('cnpj');
            $table->string('rg');
            $table->date('birthdate');
            $table->string('phone');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('email');
            $table->string('website');
            $table->string('password');
            $table->string('remember_token');
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
            $table->float('price');
            $table->dateTime('created_at');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('package_id');
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

        Schema::create('paymentcontrols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_id');
            $table->integer('portion');
            $table->dateTime('date_pay');
            $table->float('value_pay');
            $table->dateTime('created_at');
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_id');
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
        Schema::dropIfExists('paymentcontrols');
        Schema::dropIfExists('photos');
    }
}
