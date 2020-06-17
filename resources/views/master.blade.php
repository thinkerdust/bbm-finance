<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('/assets/img/favicon.png') }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Aplikasi Finance
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link href="{{ asset('/assets/css/plugins/daterangepicker.css') }}" rel="stylesheet" />
  <link href="{{ asset('/assets/bower-components/bs-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet" />
  <link href="{{ asset('/assets/css/plugins/select2.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('/assets/css/plugins/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- <link rel="stylesheet" href="{{ asset('/assets/css/plugins/font-awesome.min.css') }}"> -->
  <!-- CSS Files -->
  <link href="{{ asset('/assets/css/material-dashboard.css') }}" rel="stylesheet" />
  <!-- <link href="{{ asset('/assets/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" /> -->
</head>

<body class="">
  <div class="wrapper ">
      @include('layouts.sidebar')
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">
              @yield('title')
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="javascript:;">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Profile</a>
                  <a class="dropdown-item" href="#">Settings</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Log out
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                  </a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      @yield('content')
      <!-- footer -->
      @include('layouts.footer')
    </div>
  </div>
  
  <!--   Core JS Files   -->
  <script src="{{ asset('/assets/js/core/jquery.min.js') }}"></script>
  <script src="{{ asset('/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('/assets/js/core/bootstrap-material-design.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <!-- Plugin for the momentJs  -->
  <script src="{{ asset('/assets/js/plugins/moment.min.js') }}"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="{{ asset('/assets/js/plugins/sweetalert2.js') }}"></script>
  <!-- Forms Validations Plugin -->
  <script src="{{ asset('/assets/js/plugins/jquery.validate.min.js') }}"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="{{ asset('/assets/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="{{ asset('/assets/js/plugins/select2.full.min.js') }}"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="{{ asset('/assets/js/plugins/daterangepicker.js') }}"></script>
  <script src="{{ asset('/assets/bower-components/bs-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="{{ asset('/assets/js/plugins/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/assets/js/plugins/dataTables.bootstrap4.min.js') }}"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="{{ asset('/assets/js/plugins/bootstrap-tagsinput.js') }}"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="{{ asset('/assets/js/plugins/jasny-bootstrap.min.js') }}"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="{{ asset('/assets/js/plugins/fullcalendar.min.js') }}"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="{{ asset('/assets/js/plugins/jquery-jvectormap.js') }}"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="{{ asset('/assets/js/plugins/nouislider.min.js') }}"></script>
  <!-- Library for adding dinamically elements -->
  <script src="{{ asset('/assets/js/plugins/arrive.min.js') }}"></script>
  <!-- Chartist JS -->
  <script src="{{ asset('/assets/js/plugins/chartist.min.js') }}"></script>
  <!--  Notifications Plugin    -->
  <script src="{{ asset('/assets/js/plugins/bootstrap-notify.js') }}"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('/assets/js/material-dashboard.js') }}" type="text/javascript"></script>
  <!-- <script src="{{ asset('/assets/js/material-dashboard.js?v=2.1.2') }}" type="text/javascript"></script> -->
  <script src="{{ asset('/assets/js/custom.js') }}"></script>
</body>

</html>