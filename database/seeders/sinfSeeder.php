<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class sinfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('sinfs')->insert([
            [
                "title" => "Laravel for Beginners",
                "start_date" =>now(),
                "end_date" => now()->addMonths(2),
                "description" => "Complete Laravel course from scratch to advanced.",
                "banner_url" => "courses/laravel.jpg",
                "teacher_id" => 1
            ],
            [
                "title" => "React Mastery",
                "start_date" => now(),
                "end_date" => now()->addMonths(3),
                "description" => "Learn React with real-world projects.",
                "banner_url" => "courses/react.jpg",
                "teacher_id" => 2
            ],
         
        ]);
        //
    }
}
