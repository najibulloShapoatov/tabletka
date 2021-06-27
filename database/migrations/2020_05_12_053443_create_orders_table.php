<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->datetime('order_date');
            $table->decimal('order_sum', 12, 2)->default(0.00);
            $table->tinyInteger('order_status')->default(1);
            $table->text('order_number')->nullable();
            $table->integer('payment_type')->nullable();
            $table->string('delivery_type')->nullable();
            $table->timestamps();

            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
