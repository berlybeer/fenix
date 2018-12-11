<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>{{ $title }}</h1>
	<ul>
		@foreach($mamones as $mamon)
			<li>{{$mamon}}</li>
		@endforeach
	</ul>
</body>
</html>