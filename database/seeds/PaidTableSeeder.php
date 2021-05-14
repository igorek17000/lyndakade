<?php

use App\Course;
use App\Paid;
use App\User;
use Illuminate\Database\Seeder;

class PaidTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        $faker = Faker\Factory::create();
        while ($i < rand(500, 700)) {
            $i++;
            $paid = new Paid([
                'type' => 1,
                'factorId' => rand(0, 100000),
                'item_id' => Course::all()->random()->id,
                'user_id' => User::all()->random()->id,
                'price' => rand(2000, 100000),
                'created_at' => $faker->dateTimeBetween($startDate = '-1 months', $endDate = 'now'),
            ]);
            $paid->save();
        }
    }
}
