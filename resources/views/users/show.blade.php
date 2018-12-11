@extends('layout')

@section('title', "Usuario {$id}")

@section('content')
			<h1>{{ $title }}</h1>
            <hr>

            <ul>

              <li>{{ $id }}</li>

            </ul>

@endsection


@section('sidebar')
	@parent
	<h2>Barra lateral personalizada!</h2>
@endsection