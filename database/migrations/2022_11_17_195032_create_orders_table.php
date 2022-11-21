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
            $table->string('order_number');
            $table->foreignId('customer_id')->references('id')->on('users');
            $table->foreignId('verified_by')->reference('id')->on('users')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->decimal('amout', 10, 2);
            $table->string('status');
            $table->string('email');
            $table->string('contact');
            $table->string('shipping_agent')->nullable();
            $table->string('shipping_tracking_number')->nullable();
            $table->string('shipping_address')->nullable();
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
