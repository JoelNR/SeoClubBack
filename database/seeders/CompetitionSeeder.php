<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Competition::create([
            'title' => 'II Tirada de la liga Atirca de sala',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing, elit neque nec libero ante, odio nam euismod vel commodo. Duis maecenas tempor vulputate tortor iaculis ligula, facilisis mus torquent blandit nulla congue platea, dui et venenatis nam cras.',
            'modality' => 'Sala',
            'place' => 'Colegio Sagrado Corazón',
            'date' => '2023-01-06',
            'price' => '5.0',
        ]);
        Competition::create([
            'title' => 'III Tirada de la liga Atirca de sala',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing, elit neque nec libero ante, odio nam euismod vel commodo. Duis maecenas tempor vulputate tortor iaculis ligula, facilisis mus torquent blandit nulla congue platea, dui et venenatis nam cras.',
            'modality' => 'Sala',
            'place' => 'Colegio Sagrado Corazón',
            'date' => '2023-01-13',
            'price' => '5.0',
        ]);
        Competition::create([
            'title' => 'IV Tirada de la liga Atirca de sala',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing, elit neque nec libero ante, odio nam euismod vel commodo. Duis maecenas tempor vulputate tortor iaculis ligula, facilisis mus torquent blandit nulla congue platea, dui et venenatis nam cras.',
            'modality' => 'Sala',
            'place' => 'Colegio Sagrado Corazón',
            'date' => '2023-01-20',
            'price' => '5.0',
        ]);
        Competition::create([
            'title' => 'V Tirada de la liga Atirca de sala',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing, elit neque nec libero ante, odio nam euismod vel commodo. Duis maecenas tempor vulputate tortor iaculis ligula, facilisis mus torquent blandit nulla congue platea, dui et venenatis nam cras.',
            'modality' => 'Sala',
            'place' => 'Colegio Sagrado Corazón',
            'date' => '2023-01-27',
            'price' => '5.0',
        ]);
        Competition::create([
            'title' => 'Campeonato de canarias de Sala',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipiscing, elit neque nec libero ante, odio nam euismod vel commodo. Duis maecenas tempor vulputate tortor iaculis ligula, facilisis mus torquent blandit nulla congue platea, dui et venenatis nam cras.',
            'modality' => 'Sala',
            'place' => 'Colegio Sagrado Corazón',
            'date' => '2023-02-03',
            'price' => '15.0',
        ]);
    }
}
