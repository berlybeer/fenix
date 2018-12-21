@extends('layout')

@section('title', "Crear usuario")

@section('content')
			<div class="card w-75">
				<div class="card-header">
					<h4>Crear usuario</h4>
				</div>
				<div class="card-body">
					@if($errors->any())
					<div class="alert alert-danger">
						<h6>Por favor corrige estos errores debajo:</h6>
						<ul>
							@foreach($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach				
						</ul>

					</div>


					@endif

					<form class="needs-validation" action="{{ url('/usuarios')}}" method="POST">
					{!!csrf_field()!!}

					    <div class="form-group">
					      <label for="name">Nombre:</label>
					      <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre aquí" value={{old('name')}}>
					      @if($errors->has('name'))
					      <p>
		       				{{$errors->first('name')}}
		      			</p>
					      @endif
					    </div>
				

					
					    <div class="form-group">
					      <label for="email">Correo Electrónico:</label>
					      <input type="email" class="form-control" id="email" name="email" placeholder="user@compañia.com" value="{{old('email')}}">
					     @if($errors->has('email'))
					      <p>
		       				{{$errors->first('email')}}
		      			 </p>
					      @endif
					    </div>
				    
			

				
					  	<div class="form-group">
					      <label for="password">Contraseña:</label>
					      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
					      @if($errors->has('password'))
					      <p>
		       				{{$errors->first('password')}}
		      			  </p>
					      @endif
					    </div>

					    <div class="form-group">
					      <label for="name">Bio:</label>
					     <textarea name="bio" id="bio" class="form-control">{{ old('bio') }}</textarea>
					      @if($errors->has('bio'))
					      <p>
		       				{{$errors->first('bio')}}
		      			</p>
					      @endif
					    </div>

					    <div class="form group">
					    	<label for="profession_id">Professión</label>
					    	<select name="profession_id" id="profession_id" class="form-control">
					    		<option value="">Selecciona un valor</option>
					    		@foreach($professions as $profession)
				
					    		<option value="{{$profession->id}}"{{ old('profession_id') ==$profession->id ? ' selected' : ''}}>{{$profession->title}}</option>
					    		@endforeach
					    	</select>
					    </div>

					    <div class="form-group">
					      <label for="name">Twitter:</label>
					      <input type="text" class="form-control" id="twitter" name="twitter" placeholder="" value={{old('twitter')}}>
					      @if($errors->has('twitter'))
					      <p>
		       				{{$errors->first('twitter')}}
		      			</p>
					      @endif
					    </div>



				  


						<button class="btn btn-primary" type="submit">Crear usuario</button>
						<p class="mt-3 btn btn-link" >
						<a href="{{route("users.index")}}">Regresar</a>
						</p>
					</form>					
				</div>
			</div>

			




@endsection


