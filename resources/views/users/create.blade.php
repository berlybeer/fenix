@extends('layout')

@section('title', "Crear usuario")

@section('content')

	@card
		@slot('header', 'Nuevo usuario')
			
		@include('shared._errors')

		<form class="needs-validation" action="{{ url('/usuarios')}}" method="POST">

	  		@include('users._fields')

			<div class="form-group mt-4">
				<button class="btn btn-primary" type="submit">Crear usuario</button>
				<p class="mt-3 btn btn-link" >
				<a href="{{route("users.index")}}">Regresar</a>
			</p>
			</div>

		</form>		

	@endcard


@endsection


