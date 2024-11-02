<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Expense;
use App\Models\User;
use Carbon\Carbon;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Expense::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $expenses =  [
            [
                'userMail' => 'jeromedelodder90@gmail.com',
                'title'=> 'Hotel Anaconda',
                'category' => 'logement',
                'amount' => 1500,
                'currency' => 'THB',
                'date' => Carbon::create('2024', '05', '18')
            ]
        ];
        
        foreach($expenses as &$expense){
            $user = User::where('email', '=', $expense['userMail'])->first();

            $expense['user_id'] = $user->id;
            unset($expense['userMail']);
        }

        Expense::insert($expenses);
    }
}
