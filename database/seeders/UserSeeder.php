<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name'          =>  'admin',
                'email'         =>  'admin@admin',
                'password'      =>  bcrypt('password'),
                'nim'           =>  '000000000',
                'generation'    =>  '2018',
                'role'          =>  'admin',
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
        User::factory(100)->create();

        $tutorRole = Role::where('name', 'tutor')->first();
        $tutors = User::factory(20)->create();
        $tutorRole->users()->attach($tutors);
    }
}
