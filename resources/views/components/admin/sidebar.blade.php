<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('admin')) ? 'active' : '' }}" aria-current="page" href="/admin">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link {{ (Request::is('admin/brand*')) ? 'active' : '' }}" href="{{ route('brand.index') }}">
              <span data-feather="bold" class="align-text-bottom"></span>
              Brand
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('admin/car*')) ? 'active' : '' }}" href="{{ route('car.index') }}">
              <span data-feather="truck" class="align-text-bottom"></span>
              Car
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('admin/instructor*')) ? 'active' : '' }}" href="{{ route('instructor.index') }}">
              <span data-feather="user" class="align-text-bottom"></span>
              Instructor
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ (Request::is('admin/package*')) ? 'active' : '' }}" href="{{ route('package.index') }}">
              <span data-feather="package" class="align-text-bottom"></span>
              Package
            </a>
          </li>
          
        </ul>

        
      </div>
    </nav>