<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        Category::truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1");

        $categories = [
            ["name" =>"logement"],
            ["name" =>"alimentation"],
            ["name" =>"transport"],
            ["name" =>"loisir"],
            ["name" =>"sante"],
            ["name" =>"autre"],
        ];

        Category::insert($categories);
    }
}
