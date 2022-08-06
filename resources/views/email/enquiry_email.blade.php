{{-- @component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <h1>Enquiry message from {{ config('app_name') }}</h1>
    <h3>Enquiry details given below.</h3>
    <table>
        <tr>
            <td>Name: </td>
            <td>{{ $contacts['name'] }}</td>
        </tr>
        <tr>
            <td>Phone: </td>
            <td>{{ $contacts['phone'] }}</td>
        </tr>
        <tr>
            <td>Subject: </td>
            <td>{{ $contacts['subject'] }}</td>
        </tr>
        <tr>
            <td>Email: </td>
            <td>{{ $contacts['email'] }}</td>
        </tr>
        <tr>
            <td>Message: </td>
            <td>{{ $contacts['message'] }}</td>
        </tr>
    </table>
</body>

</html>
