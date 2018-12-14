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

    public function show($id)
    {
    	$user = User::findOrFail($id);

    	return view('users.show', compact('user'));


    }

    public function create()
    {
    	$mamones = [
    		'Juanon',
    		'Mamon',
    		'Rafa'
    	];

    	$title = "Crear nuevo usuario";
    	return view('create', compact('mamones', 'title'));
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
