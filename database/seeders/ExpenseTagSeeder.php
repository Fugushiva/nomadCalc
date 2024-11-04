<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Expense;
use App\Models\Tag;

class ExpenseTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('expense_tag')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $dataset = [
            ['title' =>"Hotel Anaconda", "tagName" => "Hôtel"],
            ['title' =>"Hotel Anaconda", "tagName" => "Économique"],
            ['title' =>"Hotel Anaconda", "tagName" => "Nuitée supplémentaire"],
        ];

        foreach($dataset as &$data){
            $expense = Expense::where('title', $data['title'])->first();
            $tag = Tag::where('name', $data['tagName'])->first();

            $data['expense_id'] = $expense->id;
            $data['tag_id'] = $tag->id;

            unset( $data['title'] );
            unset( $data['tagName'] );
        }

        DB::table('expense_tag')->insert($dataset);
    }
}
