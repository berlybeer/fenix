@extends('layout')

@section('title', "Crear usuario")

@section('content')
			<h1>Crear usuario</h1>

			<form action="{{ url('/usuarios')}}" method="POST">
			{!!csrf_field()!!}

			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="name">Nombre:</label>
			      <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre aquí">
			    </div>
			  </div>

			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="email">Email:</label>
			      <input type="email" class="form-control" id="email" name="email" placeholder="user@compañia.com">
			    </div>
			  </div>

			  <div class="form-row">
			  	<div class="form-group col-md-6">
			      <label for="password">Password:</label>
			      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
			    </div>
			  </div>
		  


				<button type="submit" class="btn btn-primary">Crear usuario</button>
				
			</form>
			<p class="mt-3">
				<a href="{{route("users.index")}}">Regresar</a>
			</p>

@endsection


@section('sidebar')
	@parent
	<h2>Barra lateral personalizada!</h2>
@endsection
