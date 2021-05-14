<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LearnPathRequest extends FormRequest
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
            'title' => 'required|min:5|max:255',
            'description' => 'required|min:30',
            'logo' => 'required|image|mimes:jpeg,png,jpg,svg',
            'titleEnglish' => 'required|min:5',
            'descriptionEnglish' => 'required|min:10',
            'courses' => 'required',
            'libraries' => 'required',
//            'durationHours' => 'required',
//            'durationMinutes' => 'required',
            'price' => 'required',
            'priceOffPercent' => 'required',
        ];
    }
}
