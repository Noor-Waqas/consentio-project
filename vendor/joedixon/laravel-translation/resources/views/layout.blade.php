<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Consentio | We Manage Compliance</title>
    <link rel="icon" href="{{ url('newfavicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('public/vendor/vendor/translation/css/main.css') }}">
</head>
<body>
    
    <div id="app">
        
        @include('translation::nav')
        @include('translation::notifications')
        
        @yield('body')
        
    </div>
    
    <script src="{{ asset('public/vendor/vendor/translation/js/app.js') }}"></script>
</body>
</html>
