<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'string|bail|required|max:25',
            'email' => 'email|bail|required|unique:users,email',
            'password1' => 'string|bail|required|same:password2',
            'password2' => 'string|bail|required|same:password1'
        ];
    }
}
