<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::table("users_roles")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");

        $dataset = [
            ['emailUser' => "jeromedelodder90@gmail.com", "role" => "role_admin"],
            ['emailUser' => "audreybelette93@gmail.com", "role" => "role_admin"],
        ];

        foreach($dataset as &$data){
            $user = User::where("email", $data["emailUser"])->first();
            $role = Role::where("slug", $data["role"])->first();

            $data["user_id"] = $user->id;
            $data["role_id"] = $role->id;

            unset($data["emailUser"]);
            unset($data["role"]);
        }

        DB::table("users_roles")->insert($dataset);

    }
}
