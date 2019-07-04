<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"/>

<body>
<h1>This One</h1>
<table border="1">
    <tr>
        <th>name</th>
        <th>email</th>
    </tr>
    @foreach($u as $n)
        <tr>
            <td>{{$n->name}}</td>
            <td>{{$n->email}}</td>
        </tr>
    @endforeach
</table>
{{ $u->links() }}
</body>
</html>