<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seu;

class SeuSeeder extends Seeder
{
    public function run()
    {
        $seus = [
            ['seus' => 'Barcelona'],
            ['seus' => 'Berlín'],
            ['seus' => 'Montreal'],
        ];

        foreach ($seus as $seu) {
            Seu::create($seu);
        }
    }
}