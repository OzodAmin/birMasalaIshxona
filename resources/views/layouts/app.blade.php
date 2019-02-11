<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    
    @include('layouts.header')
   
</head>

<body class="gray">
    <div id="wrapper">
        
        @include('layouts.navigation')

        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade in" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button> 
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade in" role="alert"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button> 
                <center>{{ $message }}</center>
            </div>
        @endif

        @yield('content')

        @include('dashboard.layouts.footer')

    </div>

    @include('layouts.scripts')
    
</body>
</html>