<!DOCTYPE html>
<html lang="en" > 
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
		<meta name="description" content="{{ $setting->translate(app()->getlocale())->content }}">
		<meta name="keyword" content="{{ $setting->translate(app()->getlocale())->title }}">
		<link rel="shortcut icon" href="{{ asset($setting->favicon) }}">
		<title>{{ $setting->translate(app()->getlocale())->title }}</title>
		@include('dashboard.layout2.head')
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('adminassets2/img/loader.svg')}}" class="loader-img" alt="Loading...">
		</div>
		<!-- /Loader -->
		@include('dashboard.layout2.main-sidebar')		
		<!-- main-content -->
		<div class="main-content app-content">
			@include('dashboard.layout2.main-header')			
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				@yield('content')
				@include('dashboard.layout2.sidebar')  <!-- sidebar that in left for notification -->
				{{-- @include('layouts.models') --}}   <!-- may need to it or not need -->
            	@include('dashboard.layout2.footer')
				@include('dashboard.layout2.footer-scripts')	
	</body>
	<script>
        var allEditors = document.querySelectorAll('#editor');
        for (var i = 0; i < allEditors.length; ++i) {
            var lang = allEditors[i].getAttribute('data-lang');
            ClassicEditor.create(allEditors[i],{
                language: {
                    // The UI will be English.
                    ui: 'en',
                    // But the content will be edited in Arabic.
                    content: lang
                    }
            }
            );
        }
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    
    @stack('javascripts')
</html>