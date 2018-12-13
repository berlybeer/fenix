@extends('layout')
@section('title', 'Usuarios')
@section('content')
	<h1>{{ $title }}</h1>
	<hr>

	<ul>
		@forelse($users as $user)
		<li>{{ $user->name}}, ({{ $user->email}})</li>
		@empty
		<p>No hay usuarios registrados</p>
		@endforelse
	</ul>
@endsection



