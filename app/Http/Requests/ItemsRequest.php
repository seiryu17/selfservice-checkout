<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsRequest extends FormRequest
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
            'brand_id' => 'required|integer|exists:inventory_brands,id',
            'category_id' => 'required|integer|exists:inventory_categories,id',
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'kode' => 'required|integer|unique:inventory_items,kode,NULL,id,deleted_at,NULL'
        ];
    }
}
