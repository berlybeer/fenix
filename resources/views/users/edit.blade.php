@extends('layout')

@section('title', "Editar usuario: {$user->id}")

@section('content')
	<div class="card w-75">
		<div class="card-header">
			<h4>Editar usuario</h4>	
		</div>
		<div class="card-body">
			
			@include('shared._errors')

			<form action="{{ url("/usuarios/$user->id")}}" method="POST">
				{{method_fieLd('PUT')}}
				{!!csrf_field()!!}

			   @include('users._fields')

				<div class="form-group mt-4">
					<button class="btn btn-primary" type="submit">Actualizar usuario</button>
					<p class="mt-3 btn btn-link" >
					<a href="{{route("users.index")}}">Regresar</a>
				</p>
				</div>
			</form>


		</div>
	</div>
			

			

@endsection


