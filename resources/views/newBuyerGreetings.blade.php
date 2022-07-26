<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>

    <img height="50px" src="https://arteastratta.es/public/frontend/images/logo.png" alt="">
    <h1>Welcome To {{ config('app_name') }}</h1>
    <h2>Hello {{ $newuser->username }}, Account created successfully</h2>
    <h4>Your password is "{{ $password }}". Click <a href="{{ route('home') }}" class="">here</a> and go to the website and change your password.</h4>
</body>

</html>
