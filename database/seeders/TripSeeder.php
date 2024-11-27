<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        Trip::truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");

        $data = [
            [
                "title" =>"Thailande 2024-2025",
                "start_date" => Carbon::create(2024, 12, 12),
                "end_date" => Carbon::create(2025, 2, 12),
                'invite_token' => Str::random(16)
            ]
        ];

        Trip::insert($data);
    }
}
