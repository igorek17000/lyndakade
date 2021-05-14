<?php

use App\Demand;
use App\User;
use Illuminate\Database\Seeder;

class DemandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demands = [
            [
                'title' => 'Unreal Engine: Lunchtime Lessons',
                'author' => 'George Maestri',
                'is_read' => 0,
                'is_done' => 0,
            ],
            [
                'title' => 'Learning Java (2018)',
                'author' => 'Kathryn Hodge',
                'is_read' => 1,
                'is_done' => 0,
            ],
            [
                'link' => 'https://www.lynda.com/Python-tutorials/Programming-Fundamentals-Real-World/418249-2.html',
                'is_read' => 1,
                'is_done' => 1,
            ],
        ];

        foreach ($demands as $demand) {
            $d = new Demand($demand);
            $d->user()->associate(User::all()->random());
            $d->save();
        }
    }
}
