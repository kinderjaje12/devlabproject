<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstrumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = 'name';
        $create_user_id = 'create_user_id';
        $photo = 'photo';
        DB::table('instrument_categories')->insert([
            [
                $name => 'Drums',
                $create_user_id => 1,
                $photo => 'http://localhost:8000/assets/drums.jpg',
            ],
            [
                $name => 'Electronic instruments',
                $create_user_id => 1,
                $photo => 'http://localhost:8000/assets/electronic-instrument.jpg',
            ],
            [
                $name => 'Equipment',
                $create_user_id => 1,
                $photo => 'http://localhost:8000/assets/equipment.jpg',
            ],
            [
                $name => 'Guitars',
                $create_user_id => 1,
                $photo => 'http://localhost:8000/assets/guitars.jpg',
            ],
            [
                $name => 'Pianos',
                $create_user_id => 1,
                $photo => 'http://localhost:8000/assets/pianos.jpg',
            ],
            [
                $name => 'Strings',
                $create_user_id => 1,
                $photo => 'http://localhost:8000/assets/String.jpg',
            ],
            [
                $name => 'Wind',
                $create_user_id => 1,
                $photo => 'http://localhost:8000/assets/Wind.jpg',
            ],
            ]);
    }
}
