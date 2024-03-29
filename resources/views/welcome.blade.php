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
        <div id="postman">
            <div class="postman-run-button"
                data-postman-action="collection/import"
                data-postman-var-1="684cb9321d046df402f8"
                data-postman-param="env%5BENV_KURSUS_MENGEMUDI%5D=W3sia2V5IjoiYmFzZV91cmwiLCJ2YWx1ZSI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkiLCJlbmFibGVkIjp0cnVlLCJ0eXBlIjoiZGVmYXVsdCIsInNlc3Npb25WYWx1ZSI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hcGkiLCJzZXNzaW9uSW5kZXgiOjB9LHsia2V5IjoidG9rZW4iLCJ2YWx1ZSI6IiIsImVuYWJsZWQiOnRydWUsInR5cGUiOiJkZWZhdWx0Iiwic2Vzc2lvblZhbHVlIjoiMTF8czZtTnZpdEZCeVluenJPRzR0S1IxbTI4cTAwdDVJSk9xbjNBWVJWbyIsInNlc3Npb25JbmRleCI6MX1d"></div>
                <script type="text/javascript">
                (function (p,o,s,t,m,a,n) {
                    !p[s] && (p[s] = function () { (p[t] || (p[t] = [])).push(arguments); });
                    !o.getElementById(s+t) && o.getElementsByTagName("head")[0].appendChild((
                    (n = o.createElement("script")),
                    (n.id = s+t), (n.async = 1), (n.src = m), n
                    ));
                }(window, document, "_pm", "PostmanRunObject", "https://run.pstmn.io/button.js"));
                </script>
        </div>
        {{-- <a href="#paket" class="btn btn-primary">Get Started</a> --}}
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

    {{-- <section class="container py-4" id="paket">
        <h2 class="text-center">Paket Kursus Mengemudi</h2>
        
        <table class="table">
            <thead>
                <th>#</th>
                <th>Package</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach ($packages as $package)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $package->name }}</td>
                        <td>
                            <a href="{{ route('studentEnroll', $package->id) }}" class="btn btn-primary">Enroll</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section> --}}


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