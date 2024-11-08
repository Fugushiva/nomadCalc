<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Currency::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $currencies = [
                [
                    'code' =>'EUR',
                    'symbol' =>'€',
                    'name' =>'Euro',
                    'Country' =>'Eurozone',
                ],
                [
                    'code' =>'USD',
                    'symbol' =>'$',
                    'name' =>'United States Dollar',
                    'Country' =>'United States',
                ],
                [
                    'code' =>'IDR',
                    'symbol' =>'Rp',
                    'name' =>'Indonesian Rupiah',
                    'Country' =>'Indonesia',
                ],
                [
                    'code' =>'THB',
                    'symbol' =>'฿',
                    'name' =>'Thai Bath',
                    'Country' =>'Thailand',
                ],
                [
                    'code' =>'HKD',
                    'symbol' =>'HK$',
                    'name' =>'Hong Kong Dollar',
                    'Country' =>'Hong Kong',
                ],
                [
                    'code' =>'CNY',
                    'symbol' =>'¥',
                    'name' =>'Chinese Yuan Renminbi',
                    'Country' =>'China',
                ],
                
            ];

            Currency::insert($currencies);
    }
}
