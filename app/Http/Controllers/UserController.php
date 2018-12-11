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
  

    	return view('users' ,compact('title', 'users'));
    }

    public function show($id)
    {
    	switch ($id) {
    		case '1':
    			$user = 'Juanon';# code...
    			break;
    		case '2':
    			$user = 'Mamon';# code...
    		break;

    		case '3':
    			$user = 'Rafa';# code...
    			break;
    		case '4':
    			$user = 'Duilio';# code...
    		break;

    		case '5':
    			$user = 'Ramon';# code...
    			break;

    		default:
    		
    			break;
    	}

    	$title = "Mostrando detalle del usuario: {$id}";
    	return view('show', compact('title', 'user'));


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
