<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->unique();
        });

        Schema::create('invoice_items', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('weight');
            $table->integer('width');
            $table->integer('height');
            $table->integer('depth');
            $table->string('invoice_id');
            $table->unsignedInteger('item_type');
            $table->foreign('item_type')->references('id')->on('item_types');
            $table->string('trackingnumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invoice_items');
        Schema::drop('item_types');
    }
}
