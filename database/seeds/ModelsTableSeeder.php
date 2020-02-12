<?php

use Illuminate\Database\Seeder;

class ModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('models')->insert([
            'makes_id' => '1',
            'name' => '3 Series',
            'drive_options' => json_encode(['1'=>'2x4'])
        ]);
        DB::table('models')->insert([
            'makes_id' => '1',
            'name' => '5 Series',
            'drive_options' => json_encode(['1'=>'2x4'])
        ]);
        DB::table('models')->insert([
            'makes_id' => '1',
            'name' => '7 Series',
            'drive_options' => json_encode(['1'=>'2x4'])
        ]);
        DB::table('models')->insert([
            'makes_id' => '2',
            'name' => 'C Class',
            'drive_options' => json_encode(['1'=>'2x4'])
        ]);
        DB::table('models')->insert([
            'makes_id' => '2',
            'name' => 'E Class',
            'drive_options' => json_encode(['1'=>'2x4'])
        ]);
        DB::table('models')->insert([
            'makes_id' => '2',
            'name' => 'S CLass',
            'drive_options' => json_encode(['1'=>'2x4'])
        ]);
        DB::table('models')->insert([
            'makes_id' => '3',
            'name' => 'Wrangler',
            'drive_options' => json_encode(['1'=>'2x4'])
        ]);
        DB::table('models')->insert([
            'makes_id' => '3',
            'name' => 'Cherokee',
            'drive_options' => json_encode(['1'=>'2x4'])
        ]);
        DB::table('models')->insert([
            'makes_id' => '3',
            'name' => 'Grand Cherokee',
            'drive_options' => json_encode(['1'=>'2x4', '2'=>'4x4'])
        ]);
    }
}
