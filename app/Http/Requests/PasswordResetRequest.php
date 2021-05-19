<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
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
            'email' => 'email|bail|required',
            'token' => 'bail|required',
            'password' => 'string|bail|required|same:password_confirmation',
            'password_confirmation' => 'string|bail|required|same:password'
        ];
    }
}
