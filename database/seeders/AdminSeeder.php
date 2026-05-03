<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            "lastName"=> "sharifi",
            "image_url"=> "/images/Hajisharifi1.jpeg",
            "user_id"=> 1,
            "bio"=> "Released in September 2024, the Apple iPhone 16 Pro Max features a 6.9-inch OLED display, a titanium frame, and the A18 Pro chip, starting at $1,199. It offers enhanced AI capabilities (Apple"
        ]);
    }
}
