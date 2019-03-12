<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
	    <title>@yield('title')</title>
	    
	    @include('layouts.header')
	   
	</head>

	<body class="gray">
	    <div id="wrapper">

	    	@if ($message = Session::get('success'))
	            <div class="notification success closeable">
	                <p>{{ $message }}</p>
	                <a class="close" href="#"></a>
	            </div>
	        @endif
	        
	        @include('layouts.navigation')
	        
			<div class="dashboard-container">
	    
		    	@include('dashboard.layouts.sidebar')

		    	<div class="dashboard-content-container" data-simplebar>
    				<div class="dashboard-content-inner" >

		        		@yield('content')      
						
						@include('dashboard.layouts.footer')
					</div>
				</div>
	        </div>  
	    </div>

	    @include('layouts.scripts')

	</body>
</html>