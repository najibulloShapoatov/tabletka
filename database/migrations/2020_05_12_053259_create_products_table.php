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
            $table->string('articul')->nullable()->unique();
            $table->integer('category_id')->unsigned();
            $table->string('title');
            $table->text('slug')->unique();
            $table->decimal('price', 12, 2)->default('0.00');
            $table->decimal('price_discount', 12, 2)->default('0.00');
            $table->decimal('quantity', 15, 2)->default('0.00');
            $table->integer('viewed')->unsigned()->default(0);
            $table->integer('sold')->unsigned()->default(0);
            $table->boolean('in_stock')->default(true);
            $table->tinyInteger('is_sale')->default(0);
            $table->tinyInteger('is_new')->default(1);
            $table->tinyInteger('is_hot')->default(0);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('instruction')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
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
