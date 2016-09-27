<?php

use Illuminate\Database\Seeder;

class ItemTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_types')->insert([
            ['type' => '1/4 Palle'],
            ['type' => '1/2 Palle'],
            ['type' => '1/1 Palle'],
            ['type' => 'Stålbur'],
            ['type' => 'IBC-Container'],
            ['type' => 'Kolli'],
            ['type' => 'Pakke'],
            ['type' => 'Brev']
        ]);
    }
}
