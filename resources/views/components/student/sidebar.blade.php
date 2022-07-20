<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('student')) ? 'active' : '' }}" aria-current="page" href="{{ route('studentIndex') }}">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('student/enrollment')) ? 'active' : '' }}" aria-current="page" href="/student/enrollment">
              <span data-feather="home" class="align-text-bottom"></span>
              Enrollment
            </a>
          </li>
          
          
          
        </ul>

        
      </div>
    </nav>