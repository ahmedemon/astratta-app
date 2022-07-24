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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name')->nullable();
            $table->string('designation')->nullable();
            $table->text('description')->nullable();

            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('stripe_id')->nullable();
            $table->string('paypal_id')->nullable();

            $table->rememberToken();
            $table->boolean('privacy_policy')->default(0);
            $table->boolean('contact_agreement')->default(0);

            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_top')->default(0);
            $table->boolean('is_active')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_blocked')->default(0);
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
        Schema::dropIfExists('sellers');
    }
};
