@extends('layout')
@section('title', 'Usuarios')
@section('content')


	<div class="d-flex justify-content-between align-items-end mb-3">
	<h1 class="pb-1">{{ $title }}</h1>
	<p>
		<a href="{{route('users.create')}}" class="btn btn-primary">Nuevo usuario</a>
	</p>
	</div>

	@if($users->isNotEmpty())

	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Nombre</th>
	      <th scope="col">Correo</th>
	      <th scope="col">Acciones</th>
	    </tr>
	  </thead>
	  <tbody>
	  @foreach($users as $user)
	    <tr>
	      <th scope="row">{{$user->id}}</th>
	      <td>{{$user->name}}</td>
	      <td>{{$user->email}}</td>
	      <td>
			@if($user->trashed())
			<form action="{{route('users.destroy', $user)}}" method="POST">
				@csrf
				@method('DELETE')
				<button type="submit" class="btn btn-link"><i class="fas fa-times-circle"></i></button>
			</form>			
			@else
			<form action="{{route('users.trash', $user)}}" method="POST">
				@csrf
				@method('PATCH')
				<a href="{{ route('users.show', $user)}}" class="btn btn-link"><i class="far fa-eye"></i></a>
				<a href="{{ route('users.edit', $user)}}"class="btn btn-link"><i class="fas fa-pencil-alt"></i></a>
				<button type="submit" class="btn btn-link"><i class="fas fa-trash-alt"></i></button>
			</form>
			@endif
	      </td>
	    </tr>
	  @endforeach
	  </tbody>
	</table>
	@else
		<p>No hay usuarios registrados</p>
	@endif

	<hr>

@endsection



