<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = 'comment';
        $instruments_id = 'instruments_id';
        $users_id = 'users_id';
        DB::table('comments')->insert([
            [
                $comment => 'gitara 1, odlican zvuk, povoljna cijena',
                $instruments_id => 1,
                $users_id => 3,
            ],
            [
                $comment => 'gitara 1 potrbno stimovnaje skroz nezadovoljan kupovinom',
                $instruments_id => 1,
                $users_id => 4,
            ],
            [
                $comment => 'kvalitet u skladu s cijenom',
                $instruments_id => 1,
                $users_id => 5,
            ],
            [
                $comment => 'Njihov najlosiji proizvod do sad',
                $instruments_id => 2,
                $users_id => 4,
            ],
            [
                $comment => 'Estetika bolja od kvaliteta',
                $instruments_id => 2,
                $users_id => 5,
            ],
            [
                $comment => 'Yamaha je opet neprikosnovena',
                $instruments_id => 3,
                $users_id => 3,
            ],
            [
                $comment => 'Koncertni klavir visokog kvaliteta',
                $instruments_id => 3,
                $users_id => 4,
            ],
            [
                $comment => 'lakirana mahagonija doprinosi boljoj estetici',
                $instruments_id => 3,
                $users_id => 5,
            ],
            ]);
    }
}
