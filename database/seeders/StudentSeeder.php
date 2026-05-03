<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            [
                "lastName"=> "ahmadi",
                "user_id"=> 2,
                "img_url"=> "somting.jpg",
                "phone_number"=> "07987654434",
                "tazkira_no"=> "0998765334556"
            ],
            [
                "lastName"=> "qasimi",
                "user_id"=> 2,
                "img_url"=> "somting.jpg",
                "phone_number"=> "07909094434",
                "tazkira_no"=> "0998765096"
            ],
        ]);
    }
}
