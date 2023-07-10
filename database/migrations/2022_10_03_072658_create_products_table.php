<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('feature_image_name');
            $table->string('feature_image_path');
            $table->string('price');
            $table->string('sale_price');
            $table->text('short_desc');
            $table->text('description');
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_product_id');
            $table->foreign('category_product_id')->references('id')->on('category_products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
            //$table->text('video');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
