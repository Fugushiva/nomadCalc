<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class StoreTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title"=> ["required","string"],
            "start_date"=> ["required","date"],
            'end_date' => ['required','date', 'after:start_date'],
        ];
    }

    public function messages(): array
    {
        return [
            "start_date.required" => "La date de début est obligatoire.",
            "start_date.date" => "La date de début doit être une date valide.",
            "end_date.required" => "La date de fin est obligatoire.",
            "end_date.date" => "La date de fin doit être une date valide.",
            "end_date.after" => "La date de fin doit être après la date de début.",
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $startDate = Carbon::parse($this->input('start_date'));
            $endDate = Carbon::parse($this->input('end_date'));
            $user = Auth::user();

            $overlappingTrip = $user->trips()->where(function($query) use ($startDate, $endDate){
                $query->where(function($query) use ($startDate, $endDate){
                    $query->where('start_date', "<=", $endDate)
                        ->where('end_date', ">=", $startDate);
                });
            })->exists();

            if ($overlappingTrip) {
                $validator->errors()->add('start_date', 'Les dates de ce voyage chevauchent un autre voyage existant.');
            }

            if ($startDate->greaterThanOrEqualTo($endDate)) {
                $validator->errors()->add('end_date', 'La date de fin doit être postérieure à la date de début.');
            }
        });
    }
}
