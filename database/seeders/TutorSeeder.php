<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $tutors = User::roleIs('tutor')->get();
        $courses = Course::all();
        foreach ($tutors as $tutor) {
            $tutor->tutors()->attach($courses->random(rand(1, 10)));
        }
    }
}
