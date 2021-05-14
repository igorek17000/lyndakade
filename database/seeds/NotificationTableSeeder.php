<?php

use App\Notification;
use Illuminate\Database\Seeder;

class NotificationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'اطلاعیه',
                'message' => 'با تبریک عید سعید فطر به تمامی هموطنان عزیز. در این روز فرخنده، تخفیف 50٪ برای خرید هر دوره آموزشی در نظر گرفته شده است.',
                'expire' => now()->addDays(1),
            ]
        ];

        foreach ($data as $d) {
            $n = new Notification($d);
            $n->save();
        }
    }
}
