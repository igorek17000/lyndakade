<?php

use App\SkillLevel;
use Illuminate\Database\Seeder;

class SkillLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skill_levels = [
            [
                'title' => 'Beginner'
            ],
            [
                'title' => 'Intermediate'
            ],
            [
                'title' => 'Advanced'
            ],
        ];

        foreach($skill_levels as $skill_level){
            $sk = new SkillLevel($skill_level);
            $sk->save();
        }
    }
}
