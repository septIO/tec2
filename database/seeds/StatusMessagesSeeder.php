<?php

use Illuminate\Database\Seeder;

class StatusMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_messages')->insert([
            ['text' => 'Afventer svar', 'status' => 0],
            ['text' => 'Chauffør ankommet til afhentning', 'status' => 1],
            ['text' => 'Afentning fuldendt', 'status' => 2],
            ['text' => 'Ankommet på leverings adressen', 'status' => 3],
            ['text' => 'Levering på adressen', 'status' => 4]
        ]);
    }
}
