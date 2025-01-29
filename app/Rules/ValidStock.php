<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Product;

class ValidStock implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $productId = request()->input(str_replace('.quantity', '.id', $attribute));
        $product = Product::find($productId);

        if($product && $product->stock < $value){
            $fail('Not enough stock for product ID: :'.$productId);
        }
    }

}
