<?php

namespace App\Http\Requests;

use App\Rules\ValidStock;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'user_id'=>'required|exists:users,id',
            'products'=>'required|array|min:1',
            'products.*.id'=>'required|exists:products,id',
            'products.*.quantity'=>['required','integer','min:1', new ValidStock],
        ];
    }
}
