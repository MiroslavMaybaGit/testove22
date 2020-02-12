<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ColorsTableSeeder::class);
         $this->call(MakesTableSeeder::class);
         $this->call(ModelsTableSeeder::class);
    }
}
