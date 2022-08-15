<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('instructor')) ? 'active' : '' }}" aria-current="page" href="{{ route('instructor.index') }}">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('instructor/history/*')) ? 'active' : '' }}" aria-current="page" href="{{ route('instructor.history') }}">
              <span data-feather="file-text" class="align-text-bottom"></span>
              History
            </a>
          </li>
          
        </ul>

        
      </div>
    </nav>