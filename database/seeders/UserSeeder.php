<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'phone' => '0888255118',
                'address' => 'Ki Tuc Xa T4',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123'),
                'image' => '55050.JPG',
                'role' => '1',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Oeung Chiva',
                'phone' => '0888255555',
                'address' => 'Ki Tuc Xa T4',
                'email' => 'chiva@gmail.com',
                'password' => bcrypt('123'),
                'image' => '202305050814IMG_8904.JPG',
                'role' => '0',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name' => 'User',
                'phone' => '0888123242',
                'address' => 'Ki Tuc Xa A3',
                'email' => 'user@gmail.com',
                'password' => bcrypt('123'),
                'image' => '202308051839man-1351317_1280.png',
                'role' => '0',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name' => 'Kunthea',
                'phone' => '0786544444',
                'address' => 'Truong Chinh, Dong Da, Hanoi',
                'email' => 'kunthea@gmail.com',
                'password' => bcrypt('123'),
                'image' => '202330051149bunny-155674_1280.png',
                'role' => '0',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name' => 'Moka',
                'phone' => '078456345',
                'address' => 'Truong Chinh, Dong Da, Hanoi',
                'email' => 'moka@gmail.com',
                'password' => bcrypt('123'),
                'image' => '202330051148penguin-158551_1280.png',
                'role' => '0',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 6,
                'name' => 'U Y',
                'phone' => '096235476',
                'address' => 'Truong Chinh, Dong Da, Hanoi',
                'email' => 'uy@gmail.com',
                'password' => bcrypt('123'),
                'image' => '202330051151doctor-2027768_1280.png',
                'role' => '0',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
