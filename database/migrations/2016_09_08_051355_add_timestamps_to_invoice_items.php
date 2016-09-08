<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimestampsToInvoiceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->addColumn('integer', 'init_start');
            $table->addColumn('integer', 'init_end');
            $table->addColumn('integer', 'depart_start');
            $table->addColumn('integer', 'depart_end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->removeColumn('init_start');
            $table->removeColumn('init_end');
            $table->removeColumn('depart_start');
            $table->removeColumn('depart_end');
        });
    }
}
