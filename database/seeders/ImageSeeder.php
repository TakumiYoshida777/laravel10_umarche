<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('images')->insert([
            [
                'owner_id' => 1,
                'filename' => 'sumple1.jpg',
                'title' => null
            ],
            [
                'owner_id' => 2,
                'filename' => 'sumple2.jpg',
                'title' => null
            ],
            [
                'owner_id' => 3,
                'filename' => 'sumple3.jpg',
                'title' => null
            ],
            [
                'owner_id' => 4,
                'filename' => 'sumple4.jpg',
                'title' => null
            ],
            [
                'owner_id' => 5,
                'filename' => 'sumple5.jpg',
                'title' => null
            ],
            [
                'owner_id' => 6,
                'filename' => 'sumple6.jpg',
                'title' => null
            ],
        ]);
    }
}
