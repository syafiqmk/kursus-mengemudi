<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kursus Mengemudi</title>
    {{-- link css --}}
    <link rel="stylesheet" href="/css/bootstrap.css">
    <style>

        body {
            min-height: 100vh;
        }

        .content {
            padding: 40px 50px;
            background: linear-gradient(rgba(0, 0, 0, 0.63)100%, rgba(0, 0, 0, 0.63)100%), url('/asset/bg-mobil.png');
            background-size: cover;
            color: white;
        }

        section {
            min-height: 100vh;
        }

        .auth a {
            text-decoration: none;
            color: white;
        }

    </style>
</head>
<body class="">

    <header class="content d-flex flex-column min-vh-100 align-items-center justify-content-center my-auto">
        <h1>Kursus Mengemudi</h1>
        <p>Belajar Mengemudi dengan cepat dan mudah dengan layanan kami.</p>
        <a href="#paket" class="btn btn-primary">Get Started</a>
        @if (auth()->guest())
            <p class="auth mt-4"><a href="{{ route('login') }}">Login</a> | <a href="{{ route('register') }}">Register</a></p>
        @else
            @if (auth()->user()->role =='admin')
                <p class="auth mt-4"><a href="/admin">Dashboard</a></p>
            @elseif(auth()->user()->role =='instructor')
                <p class="auth mt-4"><a href="/instructor">Dashboard</a></p>
            @elseif(auth()->user()->role =='student')
                <p class="auth mt-4"><a href="/student">Dashboard</a></p>
            @endif
        @endif
    </header>

    <section class="container py-4" id="paket">
        <h2 class="text-center">Paket Kursus Mengemudi</h2>
    </section>


    {{-- link script --}}
    <script src="/js/jquery-3.6.0.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    <script>
        $(document).on('click', 'a[href^="#"]', function(e) {
            e.preventDefault();

            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 800)

            return false
        })
    </script>
</body>
</html>