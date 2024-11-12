<?php

namespace App\Http\Requests;

use App\Rules\ArrayObject;
use App\Rules\DataObject;
use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        return [
       //     'event'                      => ['required', new ArrayObject],
            'payment'                       => ['required', new DataObject],
        ];
    }
}
