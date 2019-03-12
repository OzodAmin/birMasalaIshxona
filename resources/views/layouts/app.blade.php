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
            <div class="notification error closeable">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
                
                <a class="close" href="#"></a>
            </div>
        @endif
        @if ($message = Session::get('success'))
            <div class="notification success closeable">
                <p>{{ $message }}</p>
                <a class="close" href="#"></a>
            </div>
        @endif

        @yield('content')

        @include('layouts.footer')

    </div>
    
    @include('layouts.scripts')
    
</body>
</html>