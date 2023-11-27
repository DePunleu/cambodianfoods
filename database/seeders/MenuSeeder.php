<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert([
            [
                'id' => 1,
                'name_menu' => 'Breakfast',
                'description' => 'descriptions',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name_menu' => 'Lunch',
                'description' => 'descriptions',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 3,
                'name_menu' => 'Dinner',
                'description' => 'descriptions',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 4,
                'name_menu' => 'Drinks',
                'description' => 'descriptions',
                'created_at' => Carbon::now(),
            ],
            [
                'id' => 5,
                'name_menu' => 'Dessert',
                'description' => 'descriptions',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}

