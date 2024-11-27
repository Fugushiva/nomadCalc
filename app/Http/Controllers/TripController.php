<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $trips = $user->trips()->with('users')->get();


        return view("trip.index", compact("trips"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        return view("trip.create", compact("user"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        $validated['invite_token'] = Str::random(16);
        $user->trips()->create($validated);

        return redirect()->route("trip.index")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }

    public function handleInvite($token)
    {
        $trip = Trip::where("invite_token", $token)->first();

        if(!$trip){
            return redirect("/")->with("error","Ce lien d'invitation n'est pas valide");
        }

        if(!Auth::check()){
            return redirect('/login')->with('info', "veuillez vous connecter pour rejoindre le voyage");
        }

        $user = Auth::user();

        if($trip->users()->where('user_id', $user->id)->exists()){
            return redirect()->route('trip.index')->with('info', "vous êtes déjà membre de ce voyage");
        }

        $trip->users()->attach($user->id);

        return redirect()->route("expense.index")->with("success","Vous avez rejoint la route avec succès");
    }
}
