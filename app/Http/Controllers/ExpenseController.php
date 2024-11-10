<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use App\Models\Tag;
use App\Models\currency;
use Worksome\Exchange\Facades\Exchange;
use App\Http\Requests\CreateExpenseRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::with(["category", 'currency'])->get();

        return view('expense.index', [
            'expenses' => $expenses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $currencies = Currency::all();

        return view('expense.create', [
            'categories' => $categories,
            'currencies' => $currencies
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
       
        $expense = Expense::with(['category', 'tags'])->find($expense->id);

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
        $expenses = Expense::getModel();

        //last week expense
        $lastWeekExpenses = $expenses::lastWeek()->with(['category', 'tags'])->get();
        $totalAmount = $lastWeekExpenses->sum('amount');
        $currencies = $this->getCurrencies($lastWeekExpenses);
        
        $exchangeRate = $this->ExchangeRate($lastWeekExpenses);

        $categoriesWithConvertedAmount = $this->getConvertedAmountsByCategory($lastWeekExpenses);
       
        




        return view('dashboard', compact('expenses', 'lastWeekExpenses', 'exchangeRate', 'categoriesWithConvertedAmount'));
    }

    /**
     * exange rate to EU from given currencies
     * @param array $expense amount of the total of expense
     * return covered amount
     */

    public function exchangeRate($expenses)
    {
        $convertedAmount = 0;
        $targetCurrencies = ['EUR'];
       
        foreach($expenses as $expense){
            $expCurrency = $expense->currency->code;
            $expAmount = $expense->amount;

            //Get € rate
            $exchangeRate = Exchange::rates($expCurrency, $targetCurrencies); 
            $rates = $exchangeRate->getRates(); //dd($rates);
            $expRate = array_values($rates); //dd($expRate);

            $convertedAmount += round( $expAmount * $expRate[0], 2); //get exchange
          

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
    $targetCurrencies = ['EUR']; // Monnaie cible
    $categories = [];

    foreach ($expenses as $expense) {
        $categoryName = $expense->category->name;
        $expCurrency = $expense->currency->code;
        $expAmount = $expense->amount;

        // Obtenir le taux de change vers l'euro
        $exchangeRate = Exchange::rates($expCurrency, $targetCurrencies);
        $rates = $exchangeRate->getRates();
        $expRate = array_values($rates)[0]; // Premier taux de change

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
