
<!DOCTYPE html>
<html  lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocale() === 'en' ? 'ltr' : 'rtl' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="{{ $setting->translate(app()->getlocale())->content }}">
    <meta name="keyword" content="{{ $setting->translate(app()->getlocale())->title }}">
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}">
    <title>{{ $setting->translate(app()->getlocale())->title }}</title>
    <!-- Icons -->
    <link href="{{ asset('adminassets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminassets/css/simple-line-icons.css') }}" rel="stylesheet">
    
   {{-- font --}}
   <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{ asset('adminassets/dest/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

</head>
<!-- BODY options, add following classes to body to change options
         1. 'compact-nav'     	  - Switch sidebar to minified version (width 50px)
         2. 'sidebar-nav'		  - Navigation on the left
             2.1. 'sidebar-off-canvas'	- Off-Canvas
                 2.1.1 'sidebar-off-canvas-push'	- Off-Canvas which move content
                 2.1.2 'sidebar-off-canvas-with-shadow'	- Add shadow to body elements
         3. 'fixed-nav'			  - Fixed navigation
         4. 'navbar-fixed'		  - Fixed navbar
     -->

<body class="navbar-fixed sidebar-nav fixed-nav" >

      
      <!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('adminassets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>

    <header class="navbar" style="background-color: rgb(3 36 143); color:white">
        <div class="container-fluid">
            <button class="navbar-toggler mobile-toggler hidden-lg-up" type="button">&#9776;</button>
            <a class="navbar-brand" href="#" style="background-image: url({{ asset($setting->logo) }});"></a>
            
            <ul class="nav navbar-nav hidden-md-down">
                <li class="nav-item">
                    <a class="nav-link navbar-toggler layout-toggler" href="#">&#9776;</a>
                </li>
            </ul>
            <ul class="nav navbar-nav pull-left" style="background-color: #03248f;">
                <li class="nav-item dropdown" style="margin-left: 10px !important">
                    @if (auth()->user())
                        {{ auth()->user()->name }}({{ auth()->user()->status }})
                    @else
                        Not logged in
                    @endif
                </li>
            
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        <span>{{ trans('words.settings') }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-xs-center">
                            <strong>{{ trans('words.settings') }}</strong>
                        </div>
            
                        @if (auth()->user())
                            <a class="dropdown-item" href="{{ route('dashboard.users.edit', auth()->user()) }}">
                                <i class="fa fa-user"></i> {{ trans('words.user settings') }}
                            </a>
                        @endif
            
                        <div class="divider"></div>
            
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                            {{ trans('words.logout') }}
                        </a>
            
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            
                <li class="nav-item dropdown me-3">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        <span>{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
            
            
        </div>
    </header>
    @include('dashboard.layouts.sidebar')
    <!-- Main content -->
    <main class="main">
        @yield('body')
    </main>



    <footer class="footer">
        <a href="https://tecchnicaleducationofficetaize.on.drv.tw/Nasserportofolio/" target="_blank"> <span class="text-left">  developed by: Nasser alabbasi
                &copy; 2024.
            </span></a>

    </footer>
    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('adminassets/js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('adminassets/js/libs/tether.min.js') }}"></script>
    <script src="{{ asset('adminassets/js/libs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminassets/js/libs/pace.min.js') }}"></script>

    <!-- Plugins and scripts required by all views -->
    <script src="{{ asset('adminassets/js/libs/Chart.min.js') }}"></script>

    <!-- CoreUI main scripts -->
    <script src="{{ asset('adminassets/js/app.js') }}"></script>

    <!-- Grunt watch plugin -->
    {{-- <script src="{{ asset('adminassets') }}/livereload.js"></script> --}}
    
    <!-- Custom scripts required by this view -->
    <script src="{{ asset('adminassets/js/views/main.js') }}"></script>


    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    
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
</body>

</html>

{{-- ClassicEditor.create(allEditors[i],{
    language: {
// The UI will be English.
ui: 'en',
// But the content will be edited in Arabic.
content: '{{ LaravelLocalization::getCurrentLocale()}}'
 }
} --}}


{{-- for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(allEditors[i], {
        ckfinder: {
            uploadUrl: '{{ route('image.upload') }}?_token={{ csrf_token() }}',
        }
    }
    }); --}}
