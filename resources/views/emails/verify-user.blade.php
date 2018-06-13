<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h1>Verify Your Email</h1>
	<p>Click the following link to verify your email 
		<a href="{{ route('verify', $user->token) }}">{{ route('verify', $user->token) }}</a>
	</p>

</body>
</html>