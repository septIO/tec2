<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerBeforeUpdateOnInvoiceItemsTracking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE DEFINER=`root`@`localhost` TRIGGER `invoice_items_tracking_before_insert` BEFORE INSERT ON `invoice_items_tracking` FOR EACH ROW BEGIN
                SET @c = (SELECT COUNT(`status`) FROM invoice_items_tracking WHERE invoice_items_tracking.trackingnumber = new.trackingnumber);
                IF(@c = 5) THEN
                  SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = \"nope\";
                  END IF;
               SET new.status = @c;
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER `invoice_items_tracking_before_insert`;");
    }
}
