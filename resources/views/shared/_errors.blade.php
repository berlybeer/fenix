
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