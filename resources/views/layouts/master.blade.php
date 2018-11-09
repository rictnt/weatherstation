<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name','UPS') }}</title>
	@section('htmlheader')
    	@include('layouts.partials.htmlheader')
	@show
	
</head>
<body>

    	@include('layouts.partials.header')

		
      
            @yield('content')
        	

    	@include('layouts.partials.footer')



	@section('scripts')
    	@include('layouts.partials.scripts')
	@show
	
</body>
</html>