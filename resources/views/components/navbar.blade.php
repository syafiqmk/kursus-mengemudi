<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <div class="container">
    <a class="navbar-brand" href="/">Kursus Mengemudi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        {{-- <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li> --}}
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu">

            @if (auth()->user()->role == 'student')
                <li><a href="/student/profile" class="dropdown-item"><span data-feather="user"></span> Profiles</a></li>
            @elseif (auth()->user()->role == 'instructor')
                <li><a href="/instructor/profile" class="dropdown-item"><span data-feather="user"></span> Profiles</a></li>
            @endif

            <form action="{{ route('logout') }}" method="post">
                @csrf

                <button type="submit" class="dropdown-item"><span data-feather="log-out"></span> Logout</button>
            </form>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>