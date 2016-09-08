<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerToUpdateTrackTiming extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared("
            CREATE DEFINER=`root`@`localhost` TRIGGER `before_update_orders` BEFORE UPDATE ON `orders` FOR EACH ROW BEGIN
                IF (new.status = 1) THEN
               	    SET new.accepted_at = UNIX_TIMESTAMP();
                END IF;
                IF (new.status = 2) THEN
               	    SET new.init_start = UNIX_TIMESTAMP();
                END IF;
                IF (new.status = 3) THEN
                    SET new.init_end = UNIX_TIMESTAMP();
                END IF;
                IF (new.status = 4) THEN
                    SET new.depart_start = UNIX_TIMESTAMP();
                END IF;
                IF (new.status = 5) THEN
                    SET new.depart_end = UNIX_TIMESTAMP();
                END IF;
                
                IF(new.status>5) THEN
                    SET new.status = 5;
                END IF;
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
        DB::unprepared("DROP TRIGGER `before_update_orders`;");
    }
}
