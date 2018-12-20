@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
		<div class="card">
			<div class="card-header">
				<h4>Usuario #{{ $user->id }}</h4>
			</div>

			  <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
			  <div class="card-body">
{{-- 			    <h4>Usuario #{{ $user->id }}</h4> --}}
			    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
			  </div>
			  <ul class="list-group list-group-flush">
			    <li class="list-group-item">Nombre del usuario: {{ $user->name }}</li>
			    <li class="list-group-item">Correo electrónico: {{ $user->email }}</li>
{{-- 			    <li class="list-group-item">Vestibulum at eros</li> --}}
			  </ul>
			  <div class="card-body">
			  	<p class="btn btn-link">
			  		<a href="{{route("users.index")}}">Regresar</a>
			  	</p>
			    
{{-- 			    <a href="#" class="card-link">Another link</a> --}}
			  </div>
		</div>
			
			

@endsection

