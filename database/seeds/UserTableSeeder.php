<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::all()->where('name', 'admin')->first();

            User::create([
                'avatar' => 'black/img/emilyz.jpg',
                'name'           => 'Admin',
                'firstName' => 'Alexander',
                'lastName' => 'Sutton',
                'username' => 'AlexanderSutton',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('admin'),
                'remember_token' => Str::random(60),
                'email_verified_at' => now(),
                'google_id' => null,
                'role_id'        => $role->id,
            ]);
        }
//         $role = \TCG\Voyager\Models\Role::where('name', 'admin')->firstOrFail();
//         $users = [
//             [
//                 'name' => 'Alexander',
//                 'password' => Hash::make('123456'),
// //                'avatar' => 'https://via.placeholder.com/150',
//                 'avatar' => 'black/img/emilyz.jpg',
//                 'firstName' => 'Alexander',
//                 'lastName' => 'Sutton',
//                 'username' => 'AlexanderSutton',
//                 'email' => 'AlexanderSutton@dayrep.com',
//                 'email_verified_at' => now(),
//                 'remember_token' => Str::random(10),
//                 'google_id' => null,
//                 'role_id'        => $role->id,
//             ],
//             [
//                 'name' => 'Charlie',
//                 'password' => Hash::make('123456'),
// //                'avatar' => 'https://via.placeholder.com/150',
//                 'avatar' => 'black/img/emilyz.jpg',
//                 'firstName' => 'Charlie',
//                 'lastName' => 'Hobbs',
//                 'username' => 'CharlieHobbs',
//                 'email' => 'CharlieHobbs@dayrep.com',
//                 'email_verified_at' => now(),
//                 'remember_token' => Str::random(10),
//                 'google_id' => null,
//                 'role_id'        => $role->id,
//             ],
//             [
//                 'name' => 'Zara',
//                 'password' => Hash::make('123456'),
// //                'avatar' => 'https://via.placeholder.com/150',
//                 'avatar' => 'black/img/emilyz.jpg',
//                 'firstName' => 'Zara',
//                 'lastName' => 'Ross',
//                 'username' => 'ZaraRoss',
//                 'email' => 'ZaraRoss@teleworm.us',
//                 'email_verified_at' => now(),
//                 'remember_token' => Str::random(10),
//                 'google_id' => null,
//                 'role_id'        => $role->id,
//             ],
//             [
//                 'name' => 'Liam',
//                 'password' => Hash::make('123456'),
// //                'avatar' => 'https://via.placeholder.com/150',
//                 'avatar' => 'black/img/emilyz.jpg',
//                 'firstName' => 'Liam',
//                 'lastName' => 'Stanley',
//                 'username' => 'LiamStanley',
//                 'email' => 'LiamStanley@teleworm.us',
//                 'email_verified_at' => now(),
//                 'remember_token' => Str::random(10),
//                 'google_id' => null,
//                 'role_id'        => $role->id,
//             ],
// //            [
// //                'name' => '',
// //                'password' => Hash::make('123456'),
// //                'avatar' => 'https://via.placeholder.com/150',
// //                'firstName' => '',
// //                'lastName' => '',
// //                'username' => '',
// //                'email' => '',
// //                'email_verified_at' => now(),
// //                'remember_token' => Str::random(10),
// //                'google_id' => null,
// //            ],
//         ];

        // foreach ($users as $user) {
        //     $u = new User($user);
        //     $u->save();
        // }
    }
}
