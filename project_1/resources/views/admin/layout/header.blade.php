<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Car Rental - Admin Dashboard</title>
  <link rel="stylesheet" href="{{url ('admin/assets/css/styles.min.css') }}" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
      .sidebar-nav ul .sidebar-item.selected > .sidebar-link, .sidebar-nav ul .sidebar-item .sidebar-link.active, .sidebar-nav ul .sidebar-item .sidebar-link:hover {
          background-color: #5D87FF;
          color: #fff;
      }
      .sidebar-link {
          color: #2A3547;
          display: flex;
          align-items: center;
          padding: 10px 15px;
          border-radius: 7px;
          gap: normal;
          text-decoration: none;
          margin-bottom: 5px;
      }
      .sidebar-link:hover iconify-icon, .sidebar-link.active iconify-icon {
        color: white;
      }
  </style>
</head>

<body>
  @include('sweetalert::alert')
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{ url('dashboard') }}" class="text-nowrap logo-img fs-6 fw-bold text-dark text-decoration-none">
            Car Rental Admin
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="fa fa-times fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            
            <!-- Dashboard -->
            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}" aria-expanded="false">
                <span>
                  <i class="fa fa-tachometer-alt"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>

            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">MANAGEMENT</span>
            </li>

            <!-- Customers -->
            <li class="sidebar-item {{ Request::is('admin/add_customer') || Request::is('admin/manage_customers') ? 'selected' : '' }}">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <i class="fa fa-users"></i>
                </span>
                <span class="hide-menu">Customers</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level {{ Request::is('admin/add_customer') || Request::is('admin/manage_customers') ? 'show' : '' }}">
                <li class="sidebar-item">
                  <a href="{{ url('add_customer') }}" class="sidebar-link {{ Request::is('admin/add_customer') ? 'active' : '' }}">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="fa fa-circle fs-2"></i>
                    </div>
                    <span class="hide-menu">Add Customer</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="{{ url('manage_customers') }}" class="sidebar-link {{ Request::is('admin/manage_customers') ? 'active' : '' }}">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="fa fa-circle fs-2"></i>
                    </div>
                    <span class="hide-menu">Manage Customer</span>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Categories -->
            <li class="sidebar-item {{ Request::is('add_category') || Request::is('manage_category') || Request::is('edit_category/*') ? 'selected' : '' }}">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <i class="fa fa-list"></i>
                </span>
                <span class="hide-menu">Categories</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level {{ Request::is('add_category') || Request::is('manage_category') || Request::is('edit_category/*') ? 'show' : '' }}">
                <li class="sidebar-item">
                  <a href="{{ url('add_category') }}" class="sidebar-link {{ Request::is('add_category') ? 'active' : '' }}">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="fa fa-circle fs-2"></i>
                    </div>
                    <span class="hide-menu">Add Category</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="{{ url('manage_category') }}" class="sidebar-link {{ Request::is('manage_category') || Request::is('edit_category/*') ? 'active' : '' }}">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="fa fa-circle fs-2"></i>
                    </div>
                    <span class="hide-menu">Manage Category</span>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Cars -->
            <li class="sidebar-item {{ Request::is('admin/add_cars') || Request::is('admin/manage_cars') ? 'selected' : '' }}">
              <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <span>
                  <i class="fa fa-car"></i>
                </span>
                <span class="hide-menu">Cars</span>
              </a>
              <ul aria-expanded="false" class="collapse first-level {{ Request::is('admin/add_cars') || Request::is('admin/manage_cars') ? 'show' : '' }}">
                <li class="sidebar-item">
                  <a href="{{ url('add_cars') }}" class="sidebar-link {{ Request::is('admin/add_cars') ? 'active' : '' }}">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="fa fa-circle fs-2"></i>
                    </div>
                    <span class="hide-menu">Add Car</span>
                  </a>
                </li>
                <li class="sidebar-item">
                  <a href="{{ url('manage_cars') }}" class="sidebar-link {{ Request::is('admin/manage_cars') ? 'active' : '' }}">
                    <div class="round-16 d-flex align-items-center justify-content-center">
                      <i class="fa fa-circle fs-2"></i>
                    </div>
                    <span class="hide-menu">Manage Car</span>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Bookings -->
            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/manage_bookings') ? 'active' : '' }}" href="{{ url('manage_bookings') }}" aria-expanded="false">
                <span>
                  <i class="fa fa-calendar-check"></i>
                </span>
                <span class="hide-menu">Manage Bookings</span>
              </a>
            </li>

            <!-- Contact -->
            <li class="sidebar-item">
              <a class="sidebar-link {{ Request::is('admin/manage_contact') ? 'active' : '' }}" href="{{ url('manage_contact') }}" aria-expanded="false">
                <span>
                  <i class="fa fa-envelope"></i>
                </span>
                <span class="hide-menu">Manage Contact</span>
              </a>
            </li>

          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
    </aside>

    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="fa fa-bars"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{url ('admin/assets/images/profile/user1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="fa fa-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="{{url('admin-logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
          