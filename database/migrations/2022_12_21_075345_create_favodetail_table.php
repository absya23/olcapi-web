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
        Schema::create('favodetail', function (Blueprint $table) {
            $table->increments('id_fd');
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id_user')->on('user')->onUpdate('cascade');
            $table->integer('id_prod')->unsigned();
            $table->foreign('id_prod')->references('id_prod')->on('product')->onUpdate('cascade');
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
        Schema::dropIfExists('favodetail');
    }
};