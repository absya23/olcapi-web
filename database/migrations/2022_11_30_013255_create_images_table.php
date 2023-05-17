<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id_img');
            $table->integer('id_prod')->unsigned();
            $table->foreign('id_prod')->references('id_prod')->on('product')->onUpdate('cascade');
            $table->string('url')->default('https://bucket.nhanh.vn/store/7534/ps/20221126/22113414.JPG');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};