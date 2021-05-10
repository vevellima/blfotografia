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
            $table->string('email')->unique();
            $table->string('website')->unique()->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
        });

        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->datetime('created_at');
            $table->string('name_arquive');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->datetime('created_at');
        });

        Schema::create('typepackages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->datetime('created_at');
        });

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->integer('id_typepackage');
            $table->integer('id_product');
            $table->float('price');
            $table->datetime('created_at');
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_package');
            $table->integer('id_contract');
            $table->integer('id_receipt');
            $table->string('formpay');
            $table->datetime('created_at');
        });

        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('id_service');
            $table->datetime('created_at');
            $table->string('name_arquive');
        });

        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('id_service');
            $table->string('id_user');
            $table->datetime('created_at');
            $table->string('name_arquive');
            $table->string('numreceipt');
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('id_service');
            $table->string('id_user');
            $table->string('portion');
            $table->float('price');
            $table->datetime('paydate');
        });

        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('id_service');
            $table->string('day');
            $table->string('hours');
            $table->text('local');
            $table->string('address');
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
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
        Schema::dropIfExists('photos');
        Schema::dropIfExists('products');
        Schema::dropIfExists('packages');
        Schema::dropIfExists('typepackages');
        Schema::dropIfExists('services');
        Schema::dropIfExists('contracts');
        Schema::dropIfExists('receipts');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('schedules');
    }
}
