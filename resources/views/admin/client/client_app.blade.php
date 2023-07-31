<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="gb18030">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <style>

    </style>
    <title>
        @if (View::hasSection('title'))
            @yield('title')
        @else
            Consentio | {{ __('We Manage Compliance') }}
        @endif

    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href=" {{ url('img/favicon.png') }}" type="image/png">
    <script src="{{ url('backend/js/sweetalert.js') }}"></script>
    <link rel="stylesheet" href="{{ url('backend/css/sweetalert.css') }}">

    <!-- <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <!--  -->
    
    <!--  -->
    <!-- Custom fonts for this template-->
    <link href="{{ url('frontend/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
        integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
        crossorigin="anonymous" />
    <!--///////////////mycss////////-->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.css" />
    <?php
          // load this css in client to match admin form style
      if (isset($load_admin_css) && $load_admin_css == true): ?>
    <link rel="stylesheet" type="text/css" href="{{ url('backend/css/main.css') }}">
    <?php endif; ?>


    <!-- BOXicon -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/boxicons@latest/dist/boxicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="dashboard">

    <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
  <div class="outerClassNav">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/dashboard') }}" class="logo d-flex align-items-center">
        @if (!empty($company_logo))
        <div>
            <img src="{{ url('img/' . $company_logo) }}">
        </div>
        @else
        <img src="{{ url('_organisation.png') }}">
        @endif
      </a>
    </div><!-- End Logo -->

    <div class="welcome-bar d-lg-block d-none">     
      <div class=" d-flex align-items-center">
        <p>
            @if (View::hasSection('page_title'))
            @yield('page_title')
            @else
            @endif
        </p>
      </div>
    </div><!-- End welcome Bar -->
  </div>
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <!-- <i class="bi bi-list toggle-sidebar-btn"></i> -->
          </a>
        </li><!-- End Search Icon-->
       
        </li><!-- End Messages Nav -->
        <div class="secondNavDiv ">
        @if(session('locale')=='fr')
        <li class="header-flag"><a href="{{ url('language/en') }}">En</a></li>
        @elseif(session('locale')=='en')
        <li class="header-flag"><a href="{{ url('language/fr') }}">Fr</a></li>
        @endif
        <li class="nav-item dropdown pe-3"> 
        <?php
            $d_image = '_admin.png';
            $path_img = '/img';
            if (Auth::user()->role == 2) {
                $d_image = '_admin.png';
                $path_img = '/img';
            }
            if (Auth::user()->role == 3) {
                $d_image = 'dummy.jpg';
                $path_img = 'public/img2';
            }

        ?>
          <a onclick="toggleCollapse('profile');" class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if (Auth::user()->image_name == '')
            <img src="{{ URL::to('/' . $d_image) }}" style="height: 64px; width:64px;" alt="Profile" class="rounded-circle">
            @else
            <img src="{{ URL::to($path_img . '/' . Auth::user()->image_name) }}" style="height: 64px; width:64px;" alt="Profile" class="rounded-circle">
            @endif
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
          </a><!-- End Profile Iamge Icon -->

          <ul id="profile" class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('/profile/' . Auth::user()->id) }}">
                <i class="bi bi-person"></i>
                <span>My Account</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
			<!-- <li>
              <a class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#basicModal" href="#">
                <i class="bi bi-arrow-repeat"></i>
                <span>Switch Company</span>
              </a>			 
            </li>              
            <li>
              <hr class="dropdown-divider">
            </li>           -->

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('logout') }}">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </div>
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->
    <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->role != 3 || true)
        @if (in_array('Dashboard', $data))
        <li class="nav-item dashboard">
            <a class="nav-link {{ Request::segment(1) == 'dashboard' ? 'active' : '' }}" href="{{ url('/dashboard') }}">
            <img src="{{ url('assets/img/dashboard.png') }}" alt="Dashboard">
            <span>{{ __('dbrd') }}</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @endif
        @endif

        @if (in_array('My Assigned Forms', $data) || in_array('Manage Forms', $data) || in_array('Completed Forms', $data))

        <li class="nav-item">
            <a onclick="toggleCollapse('assessment-register-nav');" class="nav-link collapsed component {{ strpos(url()->current(), 'Forms/') !== false ? 'active' : '' }}" data-bs-target="#assessment-register-nav" data-bs-toggle="collapse" href="#">
            <img src="{{ url('assets/img/a-r.png') }}"  alt="Assessment Register"><div class="border__bottom"><span>Assessment Register</span></div>
            </a>

            @if (Auth::user()->role == 2 || Auth::user()->user_type == 1 || Auth::user()->role == 3)
            <ul id="assessment-register-nav" class="nav-content collapse {{ strpos(url()->current(), 'Forms/') !== false ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                @if (in_array('Manage Forms', $data))
                <li class="{{ Request::segment(2) == 'FormsList' ? 'active' : '' }}">
                    <a href="{{ url('Forms/FormsList') }}">
                    <span>{{ __('Manage Forms') }}</span>
                    </a>
                </li>
                @endif
                @if (in_array('My Assigned Forms', $data))
                <li class="{{ Request::segment(2) == 'ClientUserFormsList' ? 'active' : '' }}">
                    <a href="{{ route('client_user_subforms_list') }}">
                    <span>{{ __('My assigned Forms') }}</span>
                    </a>
                </li>
                @endif
                @if (in_array('Completed Forms', $data))
                <li class="{{ Request::segment(2) == 'CompletedFormsList' ? 'active' : '' }}">
                    <a href="{{ url('Forms/CompletedFormsList') }}">
                    <span>{{ __('Completed Forms') }}</span>
                    </a>
                </li>
                @endif
                @if (in_array('Generated Forms', $data))
                <li class="{{ Request::segment(2) == 'All_Generated_Forms' ? 'active' : '' }}">
                    <a href="{{ route('client_site_all_generated_forms') }}">
                    <span>{{ __('Generated Forms') }}</span>
                    </a>
                </li>
                @endif
            
            </ul>
            @endif
        </li><!-- End Components Nav -->
        @endif

        @if (in_array('Manage Audits', $data) || in_array('Completed Audits', $data) || in_array('Assigned Audits', $data))
        <li class="nav-item">
            <a onclick="toggleCollapse('audit-register-nav');" class="nav-link collapsed component {{ strpos(url()->current(), 'audit/') !== false ? 'active' : '' }}" data-bs-target="#audit-register-nav" data-bs-toggle="collapse" href="#">
            <img src="{{ url('assets/img/audit-reg.png') }}" alt="Audit Register"><div class="border__bottom"><span>{{ __('Audit Register') }}</span></div>
            </a>

            @if (Auth::user()->role == 2 || Auth::user()->user_type == 1 || Auth::user()->role == 3)
            <ul id="audit-register-nav" class="nav-content collapse {{ strpos(url()->current(), 'audit/') !== false ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                @if (in_array('Manage Audits', $data))
                <li class="{{ Request::is('audit/list') || Request::is('audit/sub-form/*') ? 'active' : '' }}">
                    <a href="{{ route('audit.list') }}">
                    <span>{{ __('Manage Audits') }}</span>
                    </a>
                </li>
                @endif
                @if (in_array('Assigned Audits', $data))
                <li class="{{ Request::is('audit/assssigned') ? 'active' : '' }}">
                    <a href="{{ route('audit.assssigned') }}">
                    <span>{{ __('Assigned Audits') }}</span>
                    </a>
                </li>
                @endif
                @if (in_array('Completed Audits', $data))
                <li class="{{ Request::is('audit/completed') ? 'active' : '' }}">
                    <a href="{{ route('audit.completed') }}">
                    <span>{{ __('Completed Audits') }}</span>
                    </a>
                </li>
                @endif
                @if (in_array('Generated Audits', $data))
                <li class="{{ Request::is('audit/pending') ? 'active' : '' }}">
                    <a href="{{ route('audit.pending') }}">
                    <span>{{ __('Generated Audits') }}</span>
                    </a>
                </li>
                @endif
                @if (in_array('Remediation Plans', $data))
                <li class="{{ Request::is('audit/remediation') ? 'active' : '' }}">
                    <a href="{{ url('audit/remediation') }}">
                    <span>{{ __('Remediation Plans') }}</span>
                    </a>
                </li>
                @endif
            
            </ul>
            @endif
        </li><!-- End Forms Nav -->
        @endif

        @if (Auth::user()->role == 2)
        @if (in_array('Users Management', $data))
        <li class="nav-item">
            <a class="nav-link collapsed {{ Request::segment(1) == 'users_management' || Request::segment(1) == 'add_user' ? 'active' : '' }}" href="{{ url('users_management') }}">
            <img src="{{ url('assets/img/users-manag.png') }}" alt="Users Management"><div class="border__bottom"><span>{{ __('Users Management') }}</span></div>
            </a>
        </li><!-- End Tables Nav -->
        @endif
        @endif

        @if (Auth::user()->role == 2 || Auth::user()->user_type == 1 || Auth::user()->role == 3)
        @if (in_array('Global Data Inventory', $data) || in_array('Detailed Data Inventory', $data))
        <li class="nav-item">
            <a onclick="toggleCollapse('data-inventory-nav');" class="nav-link collapsed component {{ strpos(url()->current(), 'reports') !== false ? 'active' : '' }}" data-bs-target="#data-inventory-nav" data-bs-toggle="collapse" href="#">
            <img src="{{ url('assets/img/data-in.png') }}" alt="Data Inventory"><div class="border__bottom"><span>{{ __('Data Inventory') }}</span></div>
            </a>

            <ul id="data-inventory-nav" class="nav-content collapse {{ strpos(url()->current(), 'reports/') !== false ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                
                @if (in_array('Global Data Inventory', $data))
                <li class="{{ Request::is('reports/global/inventory') ? 'active' : '' }}">
                    <a href="{{ route('summary_reports_all') }}">
                    <span>{{ __('Global Data Inventory') }}</span>
                    </a>
                </li>
                @endif
                @if (in_array('Detailed Data Inventory', $data))
                <li class="{{ Request::is('reports/detailed/inventory') ? 'active' : '' }}">
                    <a href="{{ route('detail_data_inventory_report') }}">
                    <span>{{ __('Detailed Data Inventory') }}</span>
                    </a>
                </li>
                @endif
            
            </ul>
        </li><!-- End Charts Nav -->
        @endif
        @endif

        @if (in_array('Assets List', $data))
        <li class="nav-item">
            <a class="nav-link collapsed {{ Request::segment(1) == 'assets' ? 'active' : '' }}" href="{{ route('asset_list') }}">
            <img src="{{ url('assets/img/assets-reg.png') }}" alt="Assets Register"><div class="border__bottom"><span>{{ __('Assets Register') }}</span></div>
            </a>
        </li><!-- End Icons Nav -->
        @endif

        @if (in_array('Activities List', $data))
        <li class="nav-item">
            <a class="nav-link collapsed"   href="{{ route('activity_list') }}">
            <img src="{{ url('assets/img/activities.png') }}" alt="Activities List"><div class="border__bottom"><span>{{ __('Activities List') }}</span></div>
            </a> 
        </li><!-- End Icons Nav -->
        @endif

        @if (in_array('Incident Register', $data))
        <li class="nav-item">
            <a class="nav-link collapsed {{ Request::segment(1) == 'incident' || Request::segment(1) == 'add_inccident' ? 'active' : '' }}"   href="{{ url('incident') }}">
            <img src="{{ url('assets/img/incident-reg.png') }}" alt="Incident Register"><div class="border__bottom"><span>{{ __('Incident Register') }}</span></div>
            </a> 
        </li>
        @endif
        </ul>

        @if (Auth::user()->role == 2 || Auth::user()->user_type == 1)

        @if (in_array('Sub Forms Expiry Settings', $data) || in_array('SAR Expiry Settings', $data))
        @php
            $setting = false;
            if(strpos(url()->current(), 'FormSettings') || strpos(url()->current(), 'evaluation_rate') || strpos(url()->current(), 'evaluation_rate') || strpos(url()->current(), 'assets_data_elements') || strpos(url()->current(), 'front/data-classification') || strpos(url()->current(), 'remediation-plans')){
            $setting = true;
            }
        @endphp
        <ul class="sidebar-nav sidebar-nav-bottom" id="sidebar-nav">
        <li class="nav-item settings">
            <a onclick="toggleCollapse('settings-nav');" class="nav-link collapsed component {{ Request::is('evaluation_rate') ? 'active' : '' }} {{ strpos(url()->current(), 'FormSettings') !== false ? 'active' : '' }} {{ Request::is('assets_data_elements') ? 'active' : '' }} {{ Request::is('front/data-classification') ? 'active' : '' }}" data-bs-target="#sub-forms-expiry-nav" data-bs-toggle="collapse" href="#">
            <img src="{{ url('assets/img/settings.png') }}" alt="Settings">
            <span>{{ __('Settings') }}</span>
            </a>
            <ul id="settings-nav" class="nav-content collapse {{ strpos(url()->current(), 'FormSettings') !== false ? 'show' : '' }} {{ Request::is('evaluation_rate') ? 'show' : '' }} {{ Request::is('assets_data_elements') ? 'show' : '' }} {{ Request::is('front/data-classification') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
            @if (in_array('Sub Forms Expiry Settings', $data))
            <li class="{{ Request::is('FormSettings/SubFormsExpirySettings') ? 'active' : '' }}">
                <a href="{{ url('FormSettings/SubFormsExpirySettings') }}">
                <span>{{ __('Sub Forms Expiry') }}</span>
                </a>
            </li>
            @endif
            @if (in_array('SAR Expiry Settings', $data))
            <li class="{{ Request::is('FormSettings/SARExpirySettings') ? 'active' : '' }}">
                <a href="{{ url('FormSettings/SARExpirySettings') }}">
                <span>{{ __('SAR Expiry') }}</span>
                </a>
            </li>
            @endif
            @if (in_array('Evaluation Rating', $data))
            <li class="{{ Request::is('evaluation_rate') ? 'active' : '' }}">
                <a href="{{ route('evaluation_rat') }}">
                <span>{{ __('Evaluation Rating') }}</span>
                </a>
            </li>
            @endif
            @if (in_array('Data Elements', $data))
            <li class="{{ Request::is('assets_data_elements') ? 'active' : '' }}">
                <a href="{{ route('asset_data_elements') }}">
                <span>{{ __('Data Elements') }}</span>
                </a>
            </li>
            @endif
            @if (in_array('Data Classification', $data))
            <li class="{{ Request::is('front/data-classification') ? 'active' : '' }}">
                <a href="{{ url('front/data-classification') }}">
                <span>{{ __('Data Classification') }}</span>
                </a>
            </li>  
            @endif        
            </ul>
        </li>
        <li class="nav-item logout">
            <a class="nav-link" href="{{ __('logout') }}">
            <img src="{{ url('assets/img/logout.png') }}" alt="Logout">
            <span>Logout</span>
            </a>
        </li> 
        </ul>   
        @endif
        @endif
    <!--  Success Consultant section -->
    </aside><!-- End Sidebar-->

<main id="main" class="main"> 
    
                @yield('content')

</main><!-- End #main --> 



                <!-- /.container-fluid -->



            </div>

            <!-- End of Main Content -->



            <!-- Footer -->

            <footer class="sticky-footer bg-white">

                <div class="container my-auto">

                    <div class="copyright text-center my-auto">
                        @if (Request::segment(2) == 'ShowSARAssignees')
                            <span>{{ __('Copyright') }} &copy; {{ date('Y') }}</span>
                        @else
                            <span>{{ __('Copyright') }} © Consentio | {{ __('We Manage Compliance') }}</span>
                        @endif
                    </div>

                </div>

            </footer>

            <!-- End of Footer -->



        </div>

        <!-- End of Content Wrapper -->



    </div>

    <!-- End of Page Wrapper -->



    <!-- Scroll to Top Button-->

    <a class="scroll-to-top rounded" href="#page-top">

        <i class="fas fa-angle-up"></i>

    </a>

    <!-- Core plugin JavaScript-->

    
    <!-- Custom scripts for all pages-->

    
    <!-- Page level plugins -->

    <script src="{{ url('frontend/js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->

    <script src="{{ url('frontend/js/chart-area-demo.js') }}"></script>

    <script src="{{ url('frontend/js/chart-pie-demo.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>

    <!-- Datatables scripts -->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-html5-1.6.1/datatables.min.js"></script>
    <script>
        // JavaScript function to toggle the collapse
        function toggleCollapse(targetId) {
            var targetElement = document.getElementById(targetId);
            if (targetElement) {
                targetElement.classList.toggle('show');
            }
        }
    </script>
    <script>
        window.addEventListener("load", function() {
            var imgs = document.querySelectorAll("img");
            for (var a = 0; a < imgs.length; a++) {
                var src = imgs[a].getAttribute("src");
                imgs[a].setAttribute("onerror", src);
                imgs[a].setAttribute("src", imgs[a].getAttribute("src").replace("/img/", "/public/img/"));
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.overlay_sidebar').click(function() {
                $('.sidebar').removeClass('toggled');
                $('body').removeClass('sidebar-toggled');
            });
        });
    </script>
    @stack('scripts')
</body>



</html>