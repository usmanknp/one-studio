<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link " href="{{ url('dashboard') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li><!-- End Dashboard Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-menu-button-wide"></i><span>Classes</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          @can('create_class')
          <a href="{{ url('class-create') }}">
            <i class="bi bi-circle"></i><span>Create</span>
          </a>
          @endcan
        </li>
        <li>
          <a href="{{ url('class-list') }}">
            <i class="bi bi-circle"></i><span>List</span>
          </a>
        </li>
        <li>
          <a href="{{ url('offer-create') }}">
            <i class="bi bi-circle"></i><span>Create Offer</span>
          </a>
        </li>
        <li>
          <a href="{{ url('offer-list') }}">
            <i class="bi bi-circle"></i><span>List Offer</span>
          </a>
        </li>
      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#instructor-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Instructor</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="instructor-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ url('instructor-create') }}">
            <i class="bi bi-circle"></i><span>Create</span>
          </a>
        </li>
        <li>
          <a href="{{ url('instructor-list') }}">
            <i class="bi bi-circle"></i><span>List</span>
          </a>
        </li>

      </ul>
    </li><!-- End Components Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#coupons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear"></i><span>Coupon</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="coupons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ url('coupon-create') }}">
            <i class="bi bi-circle"></i><span>Create</span>
          </a>
        </li>
        <li>
          <a href="{{ url('coupon-list') }}">
            <i class="bi bi-circle"></i><span>List</span>
          </a>
        </li>
      </ul>
    </li>


    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-gear"></i><span>Setting</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="user-create">
            <i class="bi bi-circle"></i><span>Create User</span>
          </a>
        </li>
        <li>
          <a href="user-list">
            <i class="bi bi-circle"></i><span>List User</span>
          </a>
        </li>
      </ul>
    </li>
  </ul>

</aside>
<!-- End Sidebar-->