<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
            'name' => 'string|bail|required|max:30',
            'email' => 'email|bail|required|unique:users,email',
            'initial_password' => 'string|bail|required',
            'new_password' => 'string|bail|same:new_password_confirm',
            'new_password_confirm' => 'string|bail|same:new_password'
        ];
    }
}