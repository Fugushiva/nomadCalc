<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;
use Worksome\Exchange\Facades\Exchange;
use App\Http\Requests\CreateExpenseRequest;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\select;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expenses = Expense::get();
        
        return view('expense.index', [
            'expenses' => $expenses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('expense.create',);
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
      
        return redirect()->route('expense.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        $expense = Expense::find($expense->id);

        //exchange rate
        $baseCurrency = $expense->currency;
        $targetCurrency = 'EUR';
        $amount = $expense->amount;
        $exchangeRate = Exchange::rates($baseCurrency, ['EUR','THB', 'CNY']); //Definition of exchange rates
        $rates = $exchangeRate->getRates();
        $convertedAmount = round($amount * $rates[$targetCurrency],2); //get exchange
        



        
        return view('expense.show', [
            'expense'=> $expense,
            'convertedAmount' =>$convertedAmount
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        $expense = Expense::find($expense->id);
        return view('expense.edit', [
            'expense'=> $expense
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateExpenseRequest $request, Expense $expense)
    {
        $expense = Expense::find($expense->id);
        $validated = $request->validated();
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
}
