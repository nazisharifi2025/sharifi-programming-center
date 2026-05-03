<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             DB::table('payments')->insert([
            [
                "amount" => 500,
                "student_id" => 1,
                "sinf_id" => 1
            ],
            [
                "amount" => 700,
                "student_id" => 2,
                "sinf_id" => 2
            ],
            [
                "amount" => 1000,
                "student_id" => 1,
                "sinf_id" => 2
            ],
            [
                "amount" => 300,
                "student_id" => 2,
                "sinf_id" => 1
            ]
        ]);
    }
}
