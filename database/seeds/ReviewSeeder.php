<?php

use Illuminate\Database\Seeder;
use App\Review;

class ReviewSeeder extends Seeder
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
            $review =  new Review;
            $review->user_id = 1;
            $review->book_id = 4;
            $review->content = $faker->realText($maxNbChars = 200,);
            $review->rating = $faker->biasedNumberBetween($min = 1, $max = 5, $function = 'sqrt');
            $review->save();
        }
    }
}
