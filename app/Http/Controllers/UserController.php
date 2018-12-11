<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
    	if(request()->has('empty')){
    		$users = [];
    	}else{
    		$users = [
    		'Joel',
    		'Ellie',
    		'Tess',
    		'Tommy',
    		'Bill',
    		'<script> alert("Clicker")</script>'
    		];
    	}


    	$title = 'Listado de usuarios';
  

    	return view('users.index' ,compact('title', 'users'));
    }

    public function show($id)
    {


    	$title = "Mostrando detalle del usuario: {$id}";
    	return view('users.show', compact('title', 'id'));


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
