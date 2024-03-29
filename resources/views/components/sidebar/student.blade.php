<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('student')) ? 'active' : '' }}" aria-current="page" href="{{ route('student.index') }}">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('student/car*')) ? 'active' : '' }}" aria-current="page" href="{{ route('student.car.index') }}">
              <span data-feather="truck" class="align-text-bottom"></span>
              Car
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('student/course*')) ? 'active' : '' }}" aria-current="page" href="{{ route('student.courses') }}">
              <span data-feather="package" class="align-text-bottom"></span>
              Courses
            </a>
          </li>
          
          
          
        </ul>

        
      </div>
    </nav>