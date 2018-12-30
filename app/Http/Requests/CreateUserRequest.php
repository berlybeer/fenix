<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Role;

class CreateUserRequest extends FormRequest
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
        return[
            'name' => 'required',
            'email' => ['required','email','unique:users,email'],
            'password' => 'required|min:6',
            'role' => ['nullable', Rule::in(Role::getList())],
            'bio' => 'required',
            'twitter' => 'url|nullable|present',
            'profession_id' => ['nullable', 'present', Rule::exists('professions', 'id')->whereNull('deleted_at')],
            'skills' => ['array', Rule::exists('skills', 'id')],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El campo email debe ser unico',
            'password.required' => 'El campo password es obligatorio',
            'password.min' => 'El campo password debe tener máximo 6 caracteres',
        ];
    }

    public function createUser()
    {

        DB::transaction(function (){

          
        
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'role' => $this->role ?? 'user',
                         
            ]);



            $user->profile()->create([
                'bio' => $this->bio,
                'twitter' => $this->twitter,
                'profession_id' => $this->profession_id,
            ]);

            if($this->skills != null){
                $user->skills()->attach($this->skills);
            }

            
        });
    }


}
