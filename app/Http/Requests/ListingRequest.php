<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
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
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'type' => 'required|string|max:255',
        'site_age' => 'required|integer|min:0',
        'monthly_profit' => 'required|numeric|min:0',
        'profit_margin' => 'required|numeric|min:0',
        'page_views' => 'required|integer|min:0',
        'profit_multiple' => 'required|numeric|min:0',
        'revenue_multiple' => 'required|numeric|min:0',
        'images' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image va
        ];
    }
}
