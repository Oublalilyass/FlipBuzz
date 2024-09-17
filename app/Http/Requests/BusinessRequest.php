<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessRequest extends FormRequest
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
            'listing_id' => 'required|exists:listings,id',
            'about_the_business' => 'nullable|string',
            'comparisons_benchmarking' => 'nullable|string',
            'revenue_expenses' => 'nullable|array',
            'performance_data' => 'nullable|array',
            'google_analytics_data' => 'nullable|array',
            'monetization_methods' => 'nullable|string',
            'products_services_used' => 'nullable|string',
            'sale_includes' => 'nullable|string',
            'social_media' => 'nullable|string',
            'attachments' => 'nullable|array'
        ];
    }
}
