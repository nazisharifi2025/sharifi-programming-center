<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalariySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('teacher_payments')->insert([
            [
                "year" => 2026,
                "month" => "January",
                "day" => 10,
                "amount" => 1500,
                "teacher_id" => 1
            ],
            [
                "year" => 2026,
                "month" => "February",
                "day" => 12,
                "amount" => 1600,
                "teacher_id" => 1
            ],
            [
                "year" => 2026,
                "month" => "March",
                "day" => 15,
                "amount" => 1700,
                "teacher_id" => 2
            ],
            [
                "year" => 2026,
                "month" => "April",
                "day" => 18,
                "amount" => 1800,
                "teacher_id" => 2
            ]
        ]);

    }
}
