<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<a href="{{ route('login.google') }}" class="btn btn-danger btn-block">Login with Google</a>
	<a href="{{ route('login.facebook') }}" class="btn btn-primary btn-block">Login with Facebook</a>
	<a href="{{ route('login.github') }}" class="btn btn-dark btn-block">Login with Github</a>
</body>
</html>