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
            'date' => '2023-02-06',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-02-13',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-03-13',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-03-20',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-04-10',
            'capacity' => '3'
        ]);
        InitiationDate::create([
            'date' => '2023-04-17',
            'capacity' => '3'
        ]);
    }
}
