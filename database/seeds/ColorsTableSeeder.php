<?php

use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            'name' => 'black',
        ]);
        DB::table('colors')->insert([
            'name' => 'white',
        ]);
        DB::table('colors')->insert([
            'name' => 'green',
        ]);
        DB::table('colors')->insert([
            'name' => 'blue',
        ]);
        DB::table('colors')->insert([
            'name' => 'red',
        ]);
    }
}
