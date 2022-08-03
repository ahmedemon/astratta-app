<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
    h4 {
        font-family: 'Roboto', sans-serif;
        margin: 0%;
    }

    a {
        text-align: center;
        padding: 10px;
        background-color: #15b144;
        color: white !important;
        text-decoration: none;
        border-radius: 5px;
    }
</style>

<body>
    <h1>A new seller found on {{ config('app_name') }}</h1>
    <h3>Seller details given below.</h3>
    <table>
        <tr>
            <td>
                <h4>Username: {{ $seller->username }}</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Email: {{ $seller->email }}</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Phone: {{ $seller->phone }}</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Address: {{ $seller->address ?? 'Not set yet!' }}</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>City: {{ $seller->city ?? 'Not set yet!' }}</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>State: {{ $seller->state ?? 'Not set yet!' }}</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Zip: {{ $seller->zip ?? 'Not set yet!' }}</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Password: ############</h4>
            </td>
        </tr>
        <tr>
            <td>
                <h4>Painting: Go and Checkout his/her paintings on clicking <a href="{{ route('admin.log-in') }}">here</a></h4>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <a href="{{ route('seller.log-in') }}" target="_blank">Go To Website</a>
</body>

</html>
