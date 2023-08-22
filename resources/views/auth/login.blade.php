<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Consentio | {{ __('We Manage Compliance') }}</title>
    <!-- Custom -->
    <link href="{{ url('public/assets-new/img/favicon.png')}}" rel="icon">
    <!-- Vendor CSS Files -->
    <link href="{{ url('public/assets-new/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('public/assets-new/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ url('public/assets-new/css/style.css')}}" rel="stylesheet">
    <style>
      body{
            display: flex;
            flex-direction: column;
        }
        footer{
            margin-top: auto;
        }
        .login-option-page section.section.dashboard {
            height: 90vh;
        }
    </style>
</head>

<body class="dashboard login-option-page">
    <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <img src="{{url('public/assets-new/img/logo.png')}}" alt="" style="height:30px">
      </a>
    </div><!-- End Logo -->
  </header><!-- End Header -->

  <section class="section dashboard">
      <div class="row">
        <div class="col-12">
          <div class="form-login">
            <img src="{{url('public/assets-new/img/login-logo.png')}}" class="login-logo">
            <h1>{{ __('Compliance Management') }}</h1>
            @if (Session::has('status'))
            <div class="alert alert-danger fw-bolder" style="color: red;">
                {{ session()->get('status') }}
            </div>
            @endif
          <form class="login-form" method="POST" action="{{ route('login_post') }}" id="admin_login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group row">
                  <div class="col-sm-12"> 
                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required autofocus>
                      @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                  </div>
                  <div class="col-sm-12"> 
                      <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('Password') }}" required>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                  </div>
                  <div class="col-sm-12">
                      <button type="submit" class="btn btn-primary add-btn" id="sign-in">{{ __('SIGN IN') }}</button>
                  </div>
              </div>  
          </form> 
          <div class="form-flag">
            @if(session('locale')=='fr')
            <a href="{{ url('language/en') }}">EN</a>
            @elseif(session('locale')=='en')
            <a href="{{ url('language/fr') }}">FR</a>
            @endif</div>
        </div>
        </div>
      </div>
    </section>
    <footer style="background:#ced4da;padding-top:20px;padding-bottom:20px;color:#424245;opacity:70%;" class="">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-xs-12"><a href="#" style="color:#424245;">Privacy Policy</a>   |    <a href="#" style="color:#424245;">Terms &amp; Conditions</a></div>
                <div class="col-sm-6 col-xs-12 text-right" style="color:#424245;">Copyright © 2023 Consentio Inc. All rights reserved.</div>
            </div>
        </div>
    </footer>


    <script src="{{url('public/assets-new/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.1/tinymce.min.js"></script>  
    <script src="{{url('public/assets-new/js/main.js')}}"></script>
    
    <script type="text/javascript">
        $('#reload').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'GET',
                url: '{{url("reload-captcha")}}',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
</body>

</html>