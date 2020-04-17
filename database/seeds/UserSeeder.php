<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
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
            $user = new User;
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->phone = $faker->phoneNumber;
            if($i%2 == 0){
                $user->gender = "male";
            }else{
                $user->gender = "female";
            }
            $user->password = Hash::make("12345");
            $user->save();
        }
    }
}
