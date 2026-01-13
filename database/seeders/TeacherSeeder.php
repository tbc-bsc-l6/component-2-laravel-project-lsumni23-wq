<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get teacher role ID
        $teacherRoleId = DB::table('user_roles')->where('role', 'teacher')->value('id');

        $teachers = [
            ['name' => 'Alice Johnson', 'email' => 'Alice.johnson@teacher.college.edu'],
            ['name' => 'Robert Smith', 'email' => 'Robert.smith@teacher.college.edu'],
            ['name' => 'Emily Davis', 'email' => 'Emily.davis@teacher.college.edu'],
        ];

        foreach ($teachers as $teacher) {
            // Check if teacher already exists
            $exists = DB::table('users')->where('email', $teacher['email'])->exists();
            
            if (!$exists) {
                DB::table('users')->insert([
                    'name' => $teacher['name'],
                    'email' => $teacher['email'],
                    'password' => Hash::make('password'),
                    'user_role_id' => $teacherRoleId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
