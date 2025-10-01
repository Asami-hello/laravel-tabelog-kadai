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
        Schema::create('stores', function (Blueprint $table) {
            $table->id('id'); //主キー
            $table->unsignedBigInteger('category_id'); //外部キー
            $table->string('store_name');
            $table->string('image')->nullable();
            $table->text('store_description');
            $table->string('address');
            $table->string('postal_code', 10);
            $table->string('tel', 20);
            $table->string('business_hours');
            $table->string('holiday');
            $table->integer('price')->unsigned();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
