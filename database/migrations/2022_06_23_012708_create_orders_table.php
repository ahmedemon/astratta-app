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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('seller_id');
            $table->integer('product_id');
            $table->bigInteger('order_track_id');
            $table->date('order_date');
            $table->decimal('product_price', 10, 2);
            $table->decimal('total_cost', 10, 2);
            $table->integer('method_id');
            $table->string('coupon_code')->nullable();
            $table->integer('seller_approval')->default(0);
            $table->integer('buyer_approval')->default(0);
            $table->integer('guest_id')->nullable();
            $table->integer('is_refunded')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('orders');
    }
};
