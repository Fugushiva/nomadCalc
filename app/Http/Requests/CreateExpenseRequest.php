<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExpenseRequest extends FormRequest
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
            'title' => ['required','string','min:5', 'max:60'],
            'category_id' => ['required','exists:categories,id'],
            'currency_id' => ['required','exists:currencies,id'],
            'trip_id' => ['required','exists:trips,id'],
            'tags' => ['array'],
            'tags.*' => ['required','exists:tags,id'],
            'amount' => ['required','numeric'],
            'date' => ['required','date'],
            'note'=> ['string'],
        ];
    }
}
