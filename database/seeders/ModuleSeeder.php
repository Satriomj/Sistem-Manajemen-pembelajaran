<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $courses = Course::all();
        foreach ($courses as $course) {
            Module::factory(rand(10, 25))->for($course)->create();
            // $course->modules()->;
        }
    }
}
