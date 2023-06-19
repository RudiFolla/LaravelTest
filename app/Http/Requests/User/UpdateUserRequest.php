<?php

namespace App\Http\Requests\User;

use App\Enum\UserRoleEnum;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'string|max:255',
            'email'=> 'string',
            'password' => 'string|max:255',
            'role'=> ['nullable',new Enum(UserRoleEnum::class)] 
        ];
    }
}
