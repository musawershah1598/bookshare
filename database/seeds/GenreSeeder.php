<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=1;$i<=30;$i++){
            $genre = new Genre;
            $genre->name = $faker->name;
            $genre->description = $faker->text;
            $genre->save();
        }
    }
}
