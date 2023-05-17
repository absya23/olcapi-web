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
        Schema::create('orderdetail', function (Blueprint $table) {
            $table->increments('id_od');
            $table->integer('id_order')->unsigned();
            $table->foreign('id_order')->references('id_order')->on('order')->onUpdate('cascade');
            $table->integer('id_prod')->unsigned();
            $table->foreign('id_prod')->references('id_prod')->on('product')->onUpdate('cascade');
            $table->integer('quantity')->default(0)->unsigned();
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
        Schema::dropIfExists('orderdetail');
    }
};