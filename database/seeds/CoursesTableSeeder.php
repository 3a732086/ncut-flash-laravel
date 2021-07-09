<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Course::insert([
            'name' => 'Information Desk'
        ]);
        Course::insert([
            'name' => 'Registration'
        ]);
        Course::insert([
            'name' => 'Entrance'
        ]);
        Course::insert([
            'name' => 'Direction'
        ]);
        Course::insert([
            'name' => 'Conference'
        ]);
    }
}
