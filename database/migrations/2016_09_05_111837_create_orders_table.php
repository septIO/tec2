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
            $table->string('guid')->unique()->primary();
            $table->timestamps();
            $table->string('a_name');
            $table->string('a_email');
            $table->string('a_phone');
            $table->string('a_address');
            $table->string('a_zipcode');
            $table->string('a_city');
            $table->integer('a_time');


            $table->string('l_name');
            $table->string('l_email');
            $table->string('l_phone');
            $table->string('l_address');
            $table->string('l_zipcode');
            $table->string('l_city');
            $table->integer('l_time');

            $table->addColumn('integer', 'accepted')->nullable();
            $table->addColumn('integer', 'accepted_at')->nullable();
            $table->addColumn('integer', 'status')->default(0);

            $table->addColumn('integer', 'init_start')->nullable();
            $table->addColumn('integer', 'init_end')->nullable();
            $table->addColumn('integer', 'depart_start')->nullable();
            $table->addColumn('integer', 'depart_end')->nullable();
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
