<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $uuid = request()->uuid;
        return [
            'first_name' => ['required', 'min:2', 'max:100'],
            'last_name' => ['required', 'min:2', 'max:100'],
            'email' => ['required','email','min:2', 'max:191', Rule::unique('users')->ignore($uuid,'uuid')],
            'mobile_phone' => ['nullable', 'min:9', 'max:10'],
            'home_phone' => ['nullable', 'min:9', 'max:10'],
        ];
    }
}
