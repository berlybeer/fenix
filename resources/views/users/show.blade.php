@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
			<h1>Usuario #{{ $user->id }}</h1>
			<p>Nombre del usuario: {{ $user->name }}</p>
			<p>Correo electrónico: {{ $user->email }}</p>

			<p>
				<a href="{{route("users.index")}}">Regresar</a>
			</p>

@endsection


@section('sidebar')
	@parent
	<h2>Barra lateral personalizada!</h2>
@endsection