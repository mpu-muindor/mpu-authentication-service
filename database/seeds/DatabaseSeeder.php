<?php

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
        factory(\App\Models\Faculty::class, 5)->create();
        factory(\App\Models\Department::class, 30)->create();
        factory(\App\Models\Group::class, 100)->create();
        factory(\App\Models\Professor::class, 100)->create()->each(function ($u) {
            factory(\App\Models\EmploymentData::class, 2)->create();
        });
        factory(\App\Models\Student::class, 500)->create();
        // $this->call(UserSeeder::class);
    }
}
