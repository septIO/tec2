<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimeColumnsToInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
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
        Schema::table('orders', function (Blueprint $table) {
            $table->removeColumn('integer', 'init_start');
            $table->removeColumn('integer', 'init_end');
            $table->removeColumn('integer', 'depart_start');
            $table->removeColumn('integer', 'depart_end');
        });
    }
}
