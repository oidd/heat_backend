<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class solderedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++)
        {
            DB::table('soldered')->insert([
                'Brand' => Str::random(10),
                'Model' => Str::random(10),
                'HC' => rand(3, 10) / 5,
                'VC' => rand(3, 10) / 5,
                'width' => rand(3, 10) / 5,
                'height' => rand(3, 10) / 5,
                'Connection' => Str::random(10),
                'Bar' => Str::random(10),
                'Notes' => Str::random(10),
            ]);
        }
    }
}
