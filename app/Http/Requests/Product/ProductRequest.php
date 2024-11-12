<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'price' => 'required|integer',
            'stock' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Nama tanaman harus diisi',
            'title.max:100' => 'Nama tanaman maksimal 100 karakter',
            'price.required' => 'Harga tanaman harus diisi',
            'price.integer' => 'Harga tanamana harus berupa angka',
            'stock.required' => 'Stok tanaman harus diisi',
            'stock.integer' => 'Stok tanamana harus berupa angka',
        ];
    }
}
