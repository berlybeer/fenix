<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {

    	$users = User::all();

    	$title = 'Listado de usuarios';
  

    	return view('users.index' ,compact('title', 'users'));
    }

    public function show(User $user)
    {

    	return view('users.show', compact('user'));


    }

    public function create()
    {
        return view('users.create');
    }

    public function store()
    {

        $data = request()->validate([
            'name' => 'required',
            'email' => ['required','email','unique:users,email'],
            'password' => 'required|max:6',

        ],[
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.unique' => 'El campo email debe ser unico',
            'password.required' => 'El campo password es obligatorio',
            'password.max' => 'El campo password debe tener máximo 6 caracteres',


        ]);


        
        // if(empty($data['name'])){
        //     return redirect('usuarios/nuevo')->withErrors([
        //         'name' => 'El campo es obligatorio'
        //     ]);
        // }




        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {

    	 $personas = [
    		1 => 'Javiera',
    		2 => 'Eugenia',
    		3 => 'Yolo'
    	];



    	$title = "Editar usuario con id: {$id}"; 
    	return view('edit', compact('personas', 'title','id'));
    }


}
