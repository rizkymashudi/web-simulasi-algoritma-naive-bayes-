<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- font awsome -->
    <link rel="stylesheet" href="css/fontawesome.css" />
    <link rel="stylesheet" href="css/brands.css" />
    <link rel="stylesheet" href="css/solid.css" />

    <link rel="stylesheet" href="css/gaya.css">

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light static-top">
        <div class="container">
            <a class="navbar-brand" href="{{ Route('home') }}"></a>
                <img src="logo-v2.png" alt="" width="50" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ Route('home') }}">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Data training</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    {{-- Content Wrapper --}}
    <div class="content-wrapper">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer class="page-footer font-small abu1">
        <div class="container">
            <div class="row">
                <div class="col-md-12 py-5">
                    <div class="mb-5 d-flex justify-content-center">

                        {{-- instagram --}}
                        <a class="icn" href="#" target="_blank">
                            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"></i>
                        </a>

                        {{-- github --}}
                        <a class="icn" href="https://github.com/rizkymashudi" target="_blank">
                            <i class="fab fa-github fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                        </a>

                        {{-- twitter --}}
                        <a class="icn" href="#" target="_blank">
                            <i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
                        </a>

                        {{-- linkedin --}}
                        <a class="icn" href="#" target="_blank">
                            <i class="fab fa-linkedin-in fa-lg-white-text mr-md-5 mr-3 fa-2x"></i>
                        </a>
                    </div>
                    <div class="text-center">
                        Made with <i class="fa fa-heart" style="color: #dc3545"></i> in batam
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-center py-3 abu2">© <?php echo date('Y'); ?> Copyright
            <a href="https://github.com/rizkymashudi">rizkymashudi</a>
        </div>
    </footer>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery.js"></script>
    <script src="jspopper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>