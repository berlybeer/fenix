<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit</title>
</head>
<body>
	<h1>{{$title}}</h1>
	<ul>
		@foreach($personas as $key =>$personita)
		@if($key == $id)
			<li>{{$personita}}</li>
		@endif
		@endforeach
	</ul>
	
</body>
</html>