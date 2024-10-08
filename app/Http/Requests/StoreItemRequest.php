<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            // $table->string('title');
            // $table->unsignedBigInteger('category_id');
            // $table->string('price');
            // $table->string('stock');
            // $table->text('description');
            // $table->text('image');

            'title' => 'required | string | unique:items,title',
            'price' => 'required | string',
            'stock' => 'required | string',
            'description' => 'required | string',

        ];
    }
}
