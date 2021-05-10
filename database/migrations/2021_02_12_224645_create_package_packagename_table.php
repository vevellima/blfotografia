<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagePackagenameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_packagename', function (Blueprint $table) {
            $table->unsignedBigInteger('packagename_id');
            $table->unsignedBigInteger('package_id');
            $table->foreign('packagename_id')->references('id')->on('packagenames')->onDelete('cascade');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->primary(['packagename_id', 'package_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('package_packagename');
    }
}
