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
            'content' => 'Arqueros de toda Canarias han competido en el Campeonato de España IBERDROLA al Aire Libre 2021-2022. Nos encanta ver tanta participación Canaria compitiendo fuera a nivel nacional. Dentro de los resultados obtenidos tenemos a Alberto López Pérez y Francisca Teresa Amador que consiguen plata en equipo tradicional mixto. Jorge Jose López, Jorge Julio Pérez y Nelson Eduardo Torres, bronce en equipo masculino Compuesto. Nelson Eduardo Torres, bronce en arco compuesto individual. Y por último, Carlos Luis Pey, plata Recurvo 50+. Un excelente resultado de la expedición Canaria, felicidades a todos los participantes. Agradecer el apoyo de la Federación Canaria para lograr la participación.',
            'date' => '2022-09-01',
            'image' => '/assets/img/competicion.jpeg'
        ]);
        News::create([
            'title'=> 'El equipo del club deportivo SEO consigue el quinto puesto' ,
            'content' => 'Nuestro equipo másculino recurvo ha conseguido el quinto puesto en la Fase Final Liga Nacional RFETA de Clubes. 
            El primer día clásificaron en cuarto puesto al derrotar al club Asirio y en el domingo, después de perder la primera clásificatoria contra el club Arqueros de Valdemorillo, ganaron sus siguientes encuentros para quedar al final en un histórico quinto puesto.
            ¡Enhorabuena a todo el equipo! Más que merecido premio después de la temporada que llevamos y el esfuerzo día a día.',
            'date' => '2022-07-10',
            'image' => '/assets/img/equipo.jpg'
        ]);
        News::create([
            'title'=> 'Licencias para la temporada 22/23 ya disponible' ,
            'content' => 'La Federación canaria de tiro con arco, abre el plazo de solicitud para renovar o formalizar la licencia de arquero para esta temporada. Para todos aquellos miembros del club interesados tienen la información en su correo. Deberán rellenar la documentación indicada y presentarla de forma física en el club a ser posible antes del día 15 de octubre.',
            'date' => '2022-09-10',
            'image' => '/assets/img/flechas.jpeg'
        ]);
        News::create([
            'title'=> '¡Nuevo arquero a 70 metros!' ,
            'content' => 'El pasado mes, nuestro arquero Alexander Fleitas Hernández, realizó la prueba de ascenso para los 70 metros y la completó con éxito, uniendose al grupo de ocho arqueros que dispone el club en este nivel. ¡Felicidades a Alex, a disfrutar esos 70m!',
            'date' => '2022-12-20',
            'image' => '/assets/img/ale-nivel.jpeg'
        ]);
        News::create([
            'title'=> 'Tres medallas de los arqueros del SEO en el Campeonato de Canarias de Sala 2022' ,
            'content' => 'Este fin de semana, se ha celebrado el campeonato de canarias de sala 2022 en la isla de Fuerteventura. La expedición del SEO, consiguió tres podios en diferentes categorías.
- Itziar Bravo Ruiz, oro en arco recurvo mixto (U18).
- Jorge José López Bordón, plata en arco compuesto masculino.
- Atasara Henríquez Santana, bronce en arco desnudo femenino.
Muchas felicidades a todos y también a todos los demás arqueros del club que participaron.',
            'date' => '2022-12-19',
            'image' => '/assets/img/cpt-can-sala.jpg'
        ]);
    }
}
