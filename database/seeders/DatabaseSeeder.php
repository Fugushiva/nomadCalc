<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            CurrencySeeder::class,
            TripSeeder::class,
            ExpenseSeeder::class,
            TagSeeder::class,
            RoleSeeder::class,
            ExpenseTagSeeder::class,
            UserTripSeeder::class,
            UserRoleSeeder::class,
        ]);
    }
}
