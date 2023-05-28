<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|min:5|max:150',
            'surname' => 'min:5|max:150',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:100|confirmed'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ім\'я обов\'язкове',
            'name.min' => 'Ім\'я повинно бути не менше 5 символів',
            'name.max' => 'Ім\'я повинно бути не не більше 150 символів',
            'surname.min' => 'Прізвище повинно бути не менше 5 символів',
            'surname.max' => 'Прізвище повинно бути не більше 150 символів',
            'email.required' => 'Email обов\'язковий',
            'email.email' => 'Ви маєте ввести дійстий Email',
            'email.unique' => 'Користувач з такою почтою вже зареєстрованний',
            'password.required' => 'Пароль обов\'язковий',
            'password.min' => 'Пароль має буте не менше 5 символів',
            'password.max' => 'Пароль не може бути довше 100 символів',
            'password.confirmed' => 'Для підтвердження пароля потрібно ввести такий же набір символів'
        ];
    }
}
