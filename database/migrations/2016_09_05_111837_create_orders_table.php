<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('guid')->unique();
            $table->timestamps();
            $table->string('a_name');
            $table->string('a_email');
            $table->string('a_address');
            $table->string('a_zipcode');
            $table->string('a_city');
            $table->integer('a_time');

            $table->string('l_name');
            $table->string('l_email');
            $table->string('l_address');
            $table->string('l_zipcode');
            $table->string('l_city');
            $table->integer('l_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::drop('orders');
    }
}
