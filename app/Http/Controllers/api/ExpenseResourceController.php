<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ExpenseResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function lastWeek(){
        $user = Auth::user();
        $trip = $user->trips()
        ->where('start_date','<=', Carbon::now())
        ->where('end_date','>=', Carbon::now())
        ->first();

        $expenses = Expense::lastWeek()->with("category")->where("trip_id", $trip->id)->get();

        return response()->json($expenses);
    }
}
