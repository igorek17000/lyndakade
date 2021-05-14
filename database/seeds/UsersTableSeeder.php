<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

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
    }
}
