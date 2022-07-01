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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->string('main_image');
            $table->string('product_name');
            $table->decimal('product_price', 10, 2);
            $table->integer('category');
            $table->string('tags');
            $table->text('about_this_paint')->nullable();
            $table->text('details_1')->nullable();
            $table->text('details_2')->nullable();
            $table->boolean('best_selling')->default(0);
            $table->boolean('is_purchased')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('products');
    }
};
