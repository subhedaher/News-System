<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>news | @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/modern-business.css') }}" rel="stylesheet">

    @yield('style')

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">news</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">Home</a>
                    </li>
                    @if (count($categories) < 4)
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('categories', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @else
                        @for ($i = 0; $i < 3; $i++)
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('categories', $categories[$i]->slug) }}">{{ $categories[$i]->name }}</a>
                            </li>
                        @endfor
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Others</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                @for ($i = 3; $i < count($categories); $i++)
                                    <li><a href="{{ route('categories', $categories[$i]->slug) }}"
                                            class="dropdown-item">{{ $categories[$i]->name }}</a>
                            </ul>
                        </li>
                    @endfor
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Subhe Daher {{ date('Y') }}</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>

</html>
