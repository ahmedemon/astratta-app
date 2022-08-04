<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        a {
            text-align: center;
            padding: 10px;
            background-color: #15b144;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <h1>Welcome to {{ config('app_name') }}</h1>
    <p>Hello {{ $seller->username }}, You have been registered as a seller on {{ config('app_name') }}</p>
    <a href="{{ env('APP_URL') }}">Go To Website</a>

</body>

</html>
