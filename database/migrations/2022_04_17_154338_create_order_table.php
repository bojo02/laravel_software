<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
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
            $table->string('title');
            $table->string('description');
            $table->string('email');
            $table->string('phone')->default(000);
            $table->string('name')->default('Default');
            $table->integer('delivery_id')->default(0);
            $table->integer('price');
            $table->string('status_id')->default(1);
            $table->string('format_id');
            $table->integer('user_id');
            $table->string('role_id');
            $table->integer('in_stock')->default(0);
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
}

            // $table->string('name')->default('Default');
            //$table->string('email');
           // $table->string('address');
           // $table->string('phone')->default(000);
           // $table->string('product');
           // $table->string('vision');
           // $table->string('media');
           // $table->string('size');
           // $table->string('number');
            //$table->string('pockets');
            //$table->string('eyelets');
           // $table->string('area');
           // $table->string('laminat');
           // $table->string('file');
           // $table->string('term');
           // $table->integer('delivery_id')->default(0);
           // $table->integer('price');
           // $table->string('status_id')->default(1);
           // $table->string('format_id');
           // $table->integer('user_id');
           // $table->string('role_id');
            //$table->integer('in_stock')->default(0);