<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('teachers')->insert([
            [
                "lastName"=> "sharifi",
                "degree_of_ducation"=> "bachelor",
                "phone_number"=> "07986543132",
                "image_url"=> "somting.jpg",
                "user_id"=> 4,
                "bio"=> "Released in September 2024, the Apple iPhone 16 Pro Max features a 6.9-inch OLED display, a titanium frame, and the A18 Pro chip, starting at $1,199. It offers enhanced AI capabilities (Apple"
            ],
            [
                "lastName"=> "hamidi",
                "degree_of_ducation"=> "Seconday school",
                "phone_number"=> "07986544565",
                "image_url"=> "somting.jpg",
                "user_id"=> 3,
                "bio"=> "Released in September 2024, the Apple iPhone 16 Pro Max features a 6.9-inch OLED display, a titanium frame, and the A18 Pro chip, starting at $1,199. It offers enhanced AI capabilities (Apple"
            ],
        ]);
    }
}
