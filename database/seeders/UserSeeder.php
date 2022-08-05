<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $first_name = 'first_name';
        $last_name = 'last_name';
        $email = 'email';
        $photo = 'photo';
        $verified = 'verified';
        $admin = 'admin';
        $password = 'password';

        DB::table('users')->insert([
            [
                $first_name => 'Eris',
                $last_name => 'Sutkovic',
                $verified => 1,
                $email => 'eris@admin.com',
//                $photo => '',
                $admin => 1,
                $password => bcrypt('Password1'),

            ],
            [
                $first_name => 'Antonije',
                $last_name => 'Knezevic',
                $verified => 1,
                $email => 'antonije@admin.com',
//                $photo => '',
                $admin => 1,
                $password => bcrypt('Password1'),

            ],
            [
                $first_name => 'John',
                $last_name => 'Doe',
                $verified => 1,
                $email => 'johndoe@user.com',
//                $photo => '',
                $admin => 0,
                $password => bcrypt('Password1'),
            ],
            [
                $first_name => 'John2',
                $last_name => 'Doe2',
                $verified => 1,
                $email => 'johndoe2@user.com',
//                $photo => '',
                $admin => 0,
                $password => bcrypt('Password1'),
            ],
            [
                $first_name => 'John3',
                $last_name => 'Doe3',
                $verified => 1,
                $email => 'johndoe3@user.com',
//                $photo => '',
                $admin => 0,
                $password => bcrypt('Password1'),
            ],
        ]);

    }
}
