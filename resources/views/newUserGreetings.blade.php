<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <img height="50px" src="https://arteastratta.es/public/frontend/images/logo.png" alt="">
    <h1>Welcome To {{ config('app_name') }}</h1>
    <h2>Hello {{ $user->username }}, Account created successfully</h2>
    <a href="{{ route('home') }}">Go To Website</a>
</body>

</html>
