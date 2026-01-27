<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <tr><td>Dear {{ $name }}!</td></tr><br>
    
    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Welcome to Smart Groceries. Your account has been created successfully with the information below<br></td></tr>

    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Name: {{ $name }}</td></tr>

    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Email: {{ $email }}</td></tr>

    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Password: ***** (as chosen by you)<br></td></tr>

    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Best regards</td></tr>

    <tr><td>&nbsp;<br></td></tr>
    <tr><td>Smart Groceries.</td></tr>
</body>
</html>