<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationRequest extends FormRequest
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
            "first_name"=>"required|max:50|min:3",
            "last_name"=>"required|max:50|min:3",
            "email"=>"required|email",
            "sex"=>[Rule::in('male','female')],
            "birthday"=>"required|date",
            "phone"=>"regex:(^0[567][0-9]{10}$)", //Change the regex with your country phone numbers
            "motivation"=>"required|min:20",
            "github"=>"required",
            "linked_in"=>"required",
            "skills"=>"required|min:20",
            "size"=>[Rule::in('S','M','L','XL')],
        ];
    }
}
