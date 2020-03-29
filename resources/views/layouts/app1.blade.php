<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyecto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    Proyecto1
                    <small class="float-right">
                    <a href="{{ route('post_path_create')}}">Crear Post</a>
                    </small>
                </h1>
            </div>
        </div>
        <br>
        <br>
        <br>
        <div class="container">
        @include('layouts._errors')
        @include('layouts._messages')
        @yield('content')
    </div>
    </div>
</body>
</html>
