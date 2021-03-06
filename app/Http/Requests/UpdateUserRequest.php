<?php

namespace App\Http\Requests;


use App\Role;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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

            'first_name' => 'required',
            'last_name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user)],
            'password' => '',
            'role' => [Rule::in(Role::getList())],
            'bio' => 'required',
            'twitter' => 'url|nullable|present',
            'profession_id' => ['nullable', 'present', Rule::exists('professions', 'id')->whereNull('deleted_at')],
            'skills' => ['array', Rule::exists('skills', 'id')],            
        ];
    }

    public function updateUser(User $user)
    {
    



        $user->fill([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        if($this->password != null){
            $user->password = bcrypt($this->password);
        }

        $user->save();

        $user->profile->update([
            'twitter' => $this->twitter,
            'bio' => $this->bio,
            'profession_id' => $this->profession_id,
        ]);


        $user->skills()->sync($this->skills ?: []);
    }
}
