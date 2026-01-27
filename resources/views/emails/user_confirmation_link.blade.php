<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <tr><td>Dear {{ $name }}!</td></tr><br><br>
    {{-- <tr><td>&nbsp;</td></tr> --}}
    {{-- <tr><td>Welcome to the best grocery delivery service</td></tr><br><br> --}}
    <tr><td>Please click on the link below to activate your account</td></tr><br>
    <tr><td><a href="{{ url('user/confirm/'.$code) }}">{{ url('user/confirm/'.$code) }}</a></td></tr><br><br>
    {{-- <tr><td>&nbsp;</td></tr> --}}
    <tr><td>Best Regards,</td></tr><br>
    <tr><td>Smart Groceries</td></tr>
</body>
</html>