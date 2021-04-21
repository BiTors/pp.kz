<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\product;
class BayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->check()){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       // dd($this);
        return [
            'product_id' => 'required'
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $user = auth()->user();
            $product = product::find($this->product_id);
            if ($user->balance->cash < $product->price) {
                $validator->errors()->add('insufficient_funds_in_the_account', 'Недостаточно средств на счете.');
            }
        });
    }
}
