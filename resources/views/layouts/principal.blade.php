<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>BL - FOTOGRAFIA</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{-- TODO --}}">BL - FOTOGRAFIA</a>
        <button class="navbar-toggler" type="button" data-taggle="collapse"
            data-target="#navbarText" aria-controls="navbarText"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-iten">
                    <a class="nav-link" href="{{-- TODO --}}">Home</a>
                </li>
                <li class="nav-iten">
                    <a class="nav-link" href="{{-- TODO --}}">Sobre</a>
                </li>
                <li class="nav-iten">
                    <a class="nav-link" href="{{-- TODO --}}">Protifolio</a>
                </li>
                <li class="nav-iten">
                    <a class="nav-link" href="{{-- TODO --}}">Serviços</a>
                </li>
                <li class="nav-iten">
                    <a class="nav-link" href="{{-- TODO --}}">Login</a>
                </li>
            </ul>
            <span class="navbar-text"></span>
        </div>
    </nav>

    <main role="main">
        @yield('main')
    </main>

    <!-- Optional JavaScript -->
    <!-- JQuery first, then Popper.js, Then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>
