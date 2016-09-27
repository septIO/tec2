<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class trackOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /**
         * The tracking number needs to match the following rules to
         * be considered OK.
         * It stops the validation whenever a rules is not met, and returns an error.
         *
         * The field needs to exist
         * It needs to be alpha numeric (0-9 A-D)
         * It needs to be exactly 16 characters long
         * It needs to be a string (PHP might try to convert a string containing only digits into an integer)
         * Lastly, it needs to exist in the order table.
         */
        return [
            'trackingnumber' => 'bail|required|alpha_num|size:12|string|exists:orders,guid'
        ];
    }
}
