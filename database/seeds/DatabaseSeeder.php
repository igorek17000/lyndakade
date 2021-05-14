<?php

//use FFMpeg\FFProbe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VoyagerDatabaseSeeder::class);

        $this->call(VoyagerDummyDatabaseSeeder::class);

        // $this->call(UserTableSeeder::class);

        // $this->call(LibraryTableSeeder::class);

        $this->call(SubjectTableSeeder::class);

        $this->call(SoftwareTableSeeder::class);

        $this->call(AuthorTableSeeder::class);

        $this->call(DemandTableSeeder::class);

        $this->call(NotificationTableSeeder::class);

        $this->call(CourseTableSeeder::class);

        $this->call(LearnPathTableSeeder::class);

        $this->call(BookmarkTableSeeder::class);

        $this->call(CartTableSeeder::class);

        $this->call(PaidTableSeeder::class);

        $this->call(ViewTableSeeder::class);
    }
}
