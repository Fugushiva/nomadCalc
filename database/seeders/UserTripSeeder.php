<?php

namespace Database\Seeders;

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users_trips')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $dataset = [
            [
                'email'=> 'jeromedelodder90@gmail.com',
                'title'=> 'Thailande 2024-2025',
            ],
            [
                'email'=> "audreybelette93@gmail.com",
                "title"=> "Thailande 2024-2025",
            ]
        ];

        foreach($dataset as &$data){
            $user = User::where("email", $data["email"])->first();
            $trip = Trip::where("title", $data["title"])->first();

            $data["user_id"] = $user->id;
            $data["trip_id"] = $trip->id;

            unset($data["title"]);
            unset($data["email"]);
        }

        DB::table("users_trips")->insert($dataset);
    }
}
