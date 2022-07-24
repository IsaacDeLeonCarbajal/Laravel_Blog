<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column vh-100">
    <header>
        <nav class=" navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand mb-3" href="{{ route('home') }}">Home</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbar-content">
                    <form class="ms-auto me-5 me-md-3" action="{{route('home')}}" role="search">
                        <div class="input-group mb-3">
                            <input class="form-control" type="text" name="busqueda" placeholder="Buscar publicaciones" style="border-right: none;">

                            <button class="btn btn-outline-secondary btn-buscar" type="submit"></button>
                        </div>
                    </form>

                    <ul class="navbar-nav mb-2 mb-lg-0" id="div-btn-sesion">
                        <li class="nav-item mb-3">
                            <a class="btn btn-outline-success me-3" href="{{ route('usuarios.index') }}">Mi Perfil</a>
                        </li>

                        <li class="nav-item mb-3">
                            <a class="btn btn-outline-primary me-3" href="#">Iniciar Sesión</a>
                        </li>

                        <li class="nav-item mb-3">
                            <a class="btn btn-primary" href="#">Registrarse</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="row col-12 m-0 flex-grow-1">
        <div class="col-md-8 offset-md-1 pe-0">
            @yield('content-center')
        </div>

        <div class="col-md-2 mt-5 mt-md-0 fs-5">
            @yield('content-right')
        </div>
    </div>

    @yield('content-other')

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>
