<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = optional($this->user);

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => [$user->exists ? 'nullable' : 'required', 'string', 'min:8', 'confirmed'],
        ];
    }

    /**
     * Save the user.
     *
     * @param User $user
     *
     * @return void
     */
    public function persist(User $user)
    {
        $user->name = $this->name;
        $user->email = $this->email;

        if ($this->filled('password')) {
            $user->password = Hash::make($this->password);
        }

        $user->save();
    }
}
