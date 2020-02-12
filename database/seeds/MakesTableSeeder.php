<?php

use Illuminate\Database\Seeder;

class MakesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('makes')->insert([
            'name' => 'BMW',
        ]);
        DB::table('makes')->insert([
            'name' => 'Mercedes',
        ]);
        DB::table('makes')->insert([
            'name' => 'Jeep',
        ]);
    }
}
