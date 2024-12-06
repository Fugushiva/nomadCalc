<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Currency;
use Worksome\Exchange\Facades\Exchange;
use App\Http\Requests\CreateExpenseRequest;
use App\Models\Trip;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Expense $expense)
    {
        if($request->session()->has('expenses')){
            $request->session()->forget('expenses');
        }
        //
        $expenses = Expense::with(["category", 'currency'])->get();
        $categories = Category::all();

        $minPrice = $expense->minPrice();
        $maxPrice = $expense->maxPrice();

        return view('expense.index', [
            'expenses' => $expenses,
            'categories'=> $categories,
            'minPrice'=> $minPrice,
            'maxPrice'=> $maxPrice
        ]);
    }

    public function search(Request $request, Expense $expense)
    {
        //Constant
        $minPrice = $expense->minPrice();
        $maxPrice = $expense->maxPrice();

        //User input
        $title = $request->title;
        $categoryId = $request->category;
        $minPriceInput = $request->price[0];
        $maxPriceInput = $request->price[1];
        $from = $request->schedule[0];
        $to = $request->schedule[1];
        //create a dynamic request
        $query = $expense->query();


        //conditions for dynamic request
        if(!empty($title)){
            $query->where('title','like',"%$title%");
        }
        if(!empty($categoryId) && $categoryId != "Faites votre choix" && $categoryId != "------------------"){
            $query->where("category_id", $categoryId);
        }
        if(!empty($minPriceInput)){
            $query->where('converted_amount', '>=', $minPriceInput);
        }
        if(!empty($maxPriceInput)){
            $query->where('converted_amount','<=', $maxPriceInput);
        }
        if(!empty($from)){
            $query->where('date','>=', $from);
        }
        if(!empty($to)){
            $query->where('date','<=', $to);
        }

       

        //add relations to dynamic request
        $expenses = $query->with(['category', 'currency'])->get();
        $request->session()->put('expenses', $expenses);
        //dd($request->session()->get('expenses'));
        $categories = Category::all();

        return view("expense.index", [
            "expenses"=> $expenses,
            "categories" => $categories, 
            "minPrice"=> $minPrice,
            "maxPrice"=> $maxPrice
        ]);        
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        $categories = Category::all();
        $currencies = Currency::all();
        $trips = $user->trips()->get();

        return view('expense.create', [
            'categories' => $categories,
            'currencies' => $currencies,
            "trips" => $trips
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateExpenseRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        $validated['user_id'] = $user->id;
      
        $expense = Expense::create($validated);
        $expense->converted_amount =  $this->exchangeRate([$expense]);
        $expense->save();

        if ($request->has('tags')) {
            $expense->tags()->sync($request->input('tags'));
        }

        return redirect()->route('expense.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
       
        $expense = Expense::with(['category', 'tags', "currency"])->find($expense->id);

        //exchange rate
        $convertedAmount = $this->exchangeRate( [$expense]);

        return view('expense.show', [
            'expense' => $expense,
            'convertedAmount' => $convertedAmount,
            
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $expense = Expense::with(['category', 'tags'])->find($expense->id);
        $categories = Category::all();
        $currencies = Currency::all();
        $expenseTags = $expense->tags->pluck('id')->toArray();
        $tags = Tag::all();


        return view('expense.edit', [
            'expense' => $expense,
            'categories' => $categories,
            'expenseTags' => $expenseTags,
            'tags' => $tags,
            'currencies' => $currencies	
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateExpenseRequest $request, Expense $expense)
    {
        $expense = Expense::find($expense->id);
        $validated = $request->validated();
        if ($request->has('tags')) {
            $expense->tags()->sync($request->input('tags'));
        }
        $expense->update($validated);

        return redirect()->route('expense.show', $expense->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {

        $expense->delete();

        return redirect()->route('expense.index');
    }

    public function dashboard()
    {
        DB::enableQueryLog();
        $user = Auth::user();
        $expenses = Expense::getModel();
        //get current trip
        $trip = $user->trips()
            ->where('start_date','<=', Carbon::now())
            ->where('end_date','>=', Carbon::now())
            ->first();


        //today expenses
        if($trip){
            $todayExpenses = $expenses::today()->with(['category', 'user', 'trip'])->where("trip_id", $trip->id)->get();
            $todayConvertedAmount = $todayExpenses->sum('converted_amount');
        }else{
            $todayConvertedAmount = 0;
            $todayExpenses = [];
        }

        //last week expense
        if($trip){
            $lastWeekExpenses = $expenses::lastWeek()->with(['category'])->where("trip_id", $trip->id)->get();
            $totalAmount = $lastWeekExpenses->sum('amount');
            $currencies = $this->getCurrencies($lastWeekExpenses);
            
            $exchangeRate = $this->ExchangeRate($lastWeekExpenses);
    
            $categoriesWithConvertedAmount = $this->getConvertedAmountsByCategory($lastWeekExpenses);
    
        } else{
            $lastWeekExpenses = [];
            $totalAmount = 0;
            $currencies = $this->getCurrencies($lastWeekExpenses);
            
            $exchangeRate = $this->ExchangeRate($lastWeekExpenses);
    
            $categoriesWithConvertedAmount = $this->getConvertedAmountsByCategory($lastWeekExpenses);
    
        }
       
        return view('dashboard', compact(
            'expenses',
            'lastWeekExpenses',
            'exchangeRate',
            'categoriesWithConvertedAmount',
            'todayExpenses',
            'todayConvertedAmount'
        ));
    }

    public function getCsv(Request $request, Expense $expense){
        if( $request->session()->has('expenses') ){
            $data = $request->session()->get('expenses');
            $this->download($data);
            $request->session()->forget('expenses');
        }else{
            $data = $expense->with(["category", "currency"] )->get();
            $this->download($data);
        }
      

    }

    public function download($data){
       $csvExporter = new \Laracsv\Export();
       $expenses = $data;

       //change date format
        $csvExporter->beforeEach(function($expense){
            $expense->title = mb_convert_encoding($expense->title,"UTF-8");
        });
        
        //start buffering
        ob_start();
        // download the csv file
       $csvExporter->build($expenses, [
            "title" => "Titre",
            "category.name" => "Catégorie", 
            "amount" => "Montant", 
            "currency.code" => "Devise",
            "converted_amount" => "Montant €",
            "formatted_date" => "Date"
          ])->download("depense.csv");

          //get the content of the buffer
          $csvContent = ob_get_clean();
          //replace the delimiter
          $csvContentWithCustomDelimiter = str_replace(',',';', $csvContent);


        //set the header
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="expenses.csv"');
        //BOM for UTF-8 support
        echo "\xEF\xBB\xBF";
        //output the csv content
        echo $csvContentWithCustomDelimiter;
    }



    /**
     * exange rate to EU from given currencies
     * @param array $expense amount of the total of expense
     * return covered amount
     */

     public function exchangeRate($expenses)
     {
   
         $convertedAmount = 0;
         $targetCurrency = 'EUR';
     
         // step 1 : Get all the unique currencies
    
         $currencyCodes = [];
         foreach ($expenses as $expense) {
            if(!in_array($expense->currency->code, $currencyCodes)) {
                array_push($currencyCodes, $expense->currency->code);
            }
         }
     
         // step 2 : load exchange rate once
         $exchangeRates = [];
         foreach ($currencyCodes as $code) {
             $rates = Exchange::rates($code, [$targetCurrency])->getRates();
             $exchangeRates[$code] = array_values($rates)[0]; // Stocker le taux pour chaque devise
         }
     
         // Étape 3 : Calculate convert amount
         foreach ($expenses as $expense) {
             $expCurrency = $expense->currency->code;
             $expAmount = $expense->amount;
     
             // get preload exchange rate
             $expRate = $exchangeRates[$expCurrency];
     
             $convertedAmount += round($expAmount * $expRate, 2);
         }
     
         return $convertedAmount;
     }

    /**
     * Summary of getCurrencies
     * @param \App\Models\Expense $expense
     * @return array of currencies
     */
    public function getCurrencies($expenses)
    {
        $currencies = [];
    
        foreach ($expenses as $expense) {
            if (!in_array($expense->currency->code, $currencies)) {
                $currencies[] = $expense->currency->code;
            }
        }
        return $currencies;
    }

    private function getConvertedAmountsByCategory($expenses)
    {
        $targetCurrency = 'EUR'; // Monnaie cible
        $categories = [];
    
        // Étape 1 : Regrouper les devises uniques
        if ($expenses) {
            $currencyCodes = $expenses->pluck('currency.code')->unique();
            
        
            // Étape 2 : Charger les taux de change pour toutes les devises en une seule fois
            $exchangeRates = [];
            foreach ($currencyCodes as $code) {
                $rates = Exchange::rates($code, [$targetCurrency])->getRates();
                $exchangeRates[$code] = array_values($rates)[0]; // Stocker le taux pour chaque devise
            }
        
            // Étape 3 : Parcourir les dépenses et convertir les montants
            foreach ($expenses as $expense) {
                $categoryName = $expense->category->name;
                $expCurrency = $expense->currency->code;
                $expAmount = $expense->amount;
        
                // Utiliser le taux de change préchargé
                $expRate = $exchangeRates[$expCurrency];
        
                // Convertir le montant en euros
                $amountInEuro = round($expAmount * $expRate, 2);
        
                // Ajouter le montant à la catégorie correspondante
                if (!isset($categories[$categoryName])) {
                    $categories[$categoryName] = 0;
                }
                $categories[$categoryName] += $amountInEuro;
            }

        
            return $categories;
        }
    }
}
