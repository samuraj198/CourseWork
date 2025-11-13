<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkRequest extends FormRequest
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
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'information' => 'required|string|max:300',
            'file' => 'nullable|file|mimes:zip,rar,7z,tar,gz|max:51200',
        ];
    }
}
