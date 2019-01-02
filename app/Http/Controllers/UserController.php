<?php

namespace App\Http\Controllers;

use App\Http\Forms\UserForm;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Profession;
use App\Skill;
use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
    	$users = User::orderByDesc('created_at')->simplePaginate();

    	$title = 'Listado de usuarios';
  
    	return view('users.index' ,compact('title', 'users'));
    }

    public function trashed()
    {
        

        $users = User::onlyTrashed()->get();

        $title = 'Listado de usuarios en papelera';
  
        return view('users.index' ,compact('title', 'users'));

    }

    public function show(User $user)
    {

    	return view('users.show', compact('user'));


    }

    public function create()
    {


        return new UserForm('users.create', new User);

        
    }

    public function store(CreateUserRequest $request)
    {

    
        $request->createUser();
     

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {

        return new UserForm('users.edit', $user);
    }



    public function update(UpdateUserRequest $request, User $user)
    {


        $request->updateUser($user);
     

        return redirect()->route('users.show', ['user' => $user]);
        // return redirect("/usuarios/{$user->id}");
    }

    public function trash(User $user)
    {
        $user->delete();
        $user->profile()->delete();
        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();
        $user->forceDelete();
        return redirect()->route('users.trashed');

    }


}
