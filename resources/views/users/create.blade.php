@extends('layout')

@section('title', "Crear usuario")

@section('content')
			<h1>Crear usuario</h1>

			<form action="{{ url('/usuarios')}}" method="POST">
				{!!csrf_field()!!}
				<button type="submit">Crear usuario</button>
				
			</form>
			<p>
				<a href="{{route("users.index")}}">Regresar</a>
			</p>

@endsection


@section('sidebar')
	@parent
	<h2>Barra lateral personalizada!</h2>
@endsection
