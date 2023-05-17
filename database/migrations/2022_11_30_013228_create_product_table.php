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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id_prod');
            $table->integer('id_type')->unsigned();
            $table->foreign('id_type')->references('id_type')->on('typeproduct')->onUpdate('cascade');
            $table->string('name',200);
            $table->integer('price')->default(0)->unsigned();
            $table->string('image');
            $table->string('description')->nullable()->default('');
            $table->integer('quantity')->default(0)->unsigned();
            $table->boolean('del_flag')->default(false);
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
        Schema::dropIfExists('product');
    }
};