<?php

namespace Database\Seeders;

use App\Models\InitiationDate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitiationDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InitiationDate::create([
            'date' => '2023-01-02',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-01-09',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-01-16',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-01-23',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-02-06',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-02-13',
            'capacity' => '3'
        ]);
    }
}
