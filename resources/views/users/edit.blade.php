@extends('layout')

@section('title', "Editar usuario: {$user->id}")

@section('content')
	<div class="card w-75">
		<div class="card-header">
			<h4>Editar usuario</h4>	
		</div>
		<div class="card-body">
			

			@if($errors->any())
			<div class="alert alert-danger col-md-6">
				<h6>Por favor corrige estos errores debajo:</h6>
				<ul>
					@foreach($errors->all() as $error)
						<li>{{$error}}</li>
					@endforeach				
				</ul>

			</div>


			@endif

			<form action="{{ url("/usuarios/$user->id")}}" method="POST">
			{{method_fieLd('PUT')}}
			{!!csrf_field()!!}

			    <div class="form-group">
			      <label for="name">Nombre:</label>
			      <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre aquí" value={{old('name', $user->name)}}>
			      @if($errors->has('name'))
			      <p>
       				{{$errors->first('name')}}
      			</p>
			      @endif


			    </div>


			    <div class="form-group">
			      <label for="email">Email:</label>
			      <input type="email" class="form-control" id="email" name="email" placeholder="user@compañia.com" value="{{old('email', $user->email)}}">
			     @if($errors->has('email'))
			      <p>
       				{{$errors->first('email')}}
      			 </p>
			      @endif
			    </div>
		    


			  	<div class="form-group">
			      <label for="password">Password:</label>
			      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
			      @if($errors->has('password'))
			      <p>
       				{{$errors->first('password')}}
      			  </p>
			      @endif
			    </div>

		  


				<button class="btn btn-primary" type="submit">Actualizar usuario</button>
				<p class="mt-3 btn btn-link">
				<a href="{{route("users.index")}}">Regresar</a>
				</p>
				
			</form>


		</div>
	</div>
			

			

@endsection


