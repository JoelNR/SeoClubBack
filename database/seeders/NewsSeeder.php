<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        News::create([
            'title'=> 'Arqueros canarios en el Campeonato de España IBERDROLA al Aire Libre 2021-2022' ,
            'content' => 'Esta semana pasada, arqueros de toda Canarias han competido en el Campeonato de España IBERDROLA al Aire Libre 2021-2022. Nos encanta ver tanta participación Canaria compitiendo fuera a nivel nacional.
            Resultados:
            - Alberto López Pérez y Francisca Teresa Amador, Plata en equipo tradicional mixto.
            - Jorge Jose López, Jorge Julio Pérez y Nelson Eduardo Torres, Bronce en equipo masculino Compuesto.
            - Nelson Eduardo Torres, Bronce en arco compuesto.
            - Carlos Luis Pey, Plata Recurvo 50+.
            Un excelente resultado de la expedición Canaria, felicidades a todos los participantes!!
            Agradecer el apoyo de la Federación Canaria para lograr la participación.',
            'date' => '2022-09-01 11:04:22'
        ]);
        News::create([
            'title'=> 'El equipo del club deportivo SEO consigue el quinto puesto' ,
            'content' => 'Nuestro equipo másculino recurvo ha conseguido el quinto puesto en la Fase Final Liga Nacional RFETA de Clubes. 
            El primer día clásificaron en cuarto puesto al derrotar al club Asirio y en el domingo, después de perder la primera clásificatoria contra el club Arqueros de Valdemorillo, ganaron sus siguientes encuentros para quedar al final en un histórico quinto puesto.
            
            ¡Enhorabuena a todo el equipo! Más que merecido premio después de la temporada que llevamos y el esfuerzo día a día.',
            'date' => '2022-07-10 11:04:22'
        ]);

        News::factory(2)->create();
    }
}
