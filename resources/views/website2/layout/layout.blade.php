<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocale() === 'en' ? 'ltr' : 'rtl' }}">
   <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title> @yield('title' , $setting->translate(app()->getlocale())->title)</title>
      <meta name ="description", content="@yield('meta_description',  $setting->content )">
      <meta name ="keywords", content="@yield('meta_keywords',  $setting->title )">
      
       <!-- Favicon -->
      <link href="{{ asset($setting->favicon) }}" rel="icon">

      <link href="{{ asset('adminassets/dest/style.css') }}" rel="stylesheet">
       <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     
      <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
      {{-- /////bootstrap files --}}
      {{-- <link rel="stylesheet" href="{{asset('front2')}}/css/all.min.css">
      <link rel="stylesheet" href="{{asset('front2')}}/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{asset('front2')}}/css/bootstrap.min.css.map"> --}}
     
      <!-- Main styles for this application -->
      <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
      {{-- ////end bootstrap files --}}
      <link rel="stylesheet" href="{{asset('front2')}}/css/header.css">
       @yield('styles')
      <link rel="stylesheet" href="{{asset('front2')}}/css/main.css" />
      <link rel="stylesheet" href="{{asset('front2')}}/css/footer.css">
      <link rel="stylesheet" href="{{asset('front2')}}/css/normalize.css" />
      <script src="{{asset('front2')}}/js/lang.js"></script>
     
   </head>
   <body>
      <header>
         <nav class="nav main-nav" dir="{{ LaravelLocalization::getCurrentLocale() === 'en' ? 'ltr' : 'rtl' }}">
            <div class="logo">
               <!-- <span> تعز برس </span> -->
               <img src="{{asset($setting->logo)}}" alt="logo"
               width="100%"
               height="100%"
               >
            </div>
            <ul class="mobile">
              <li><a href="{{Route('index')}}" >   {{trans('words.home')}} </a></li>
              @if(count($categories) > 0)
             
                   @foreach ($categories as $key => $category)
                       <li><a href="{{Route('category',$category->id)}}" > {{ $category->title }} </a></li>
                   @endforeach
             
              @else
               <p>No categories available.</p>
              @endif
            </ul>
         
            
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
   $(document).ready(function() {
     // Check if there is a stored active item
     var activeItem = sessionStorage.getItem('activeItem');
     if (activeItem) {
       $('.mobile a').removeClass('active'); // Remove the active class from all items
       $('.mobile a[href="' + activeItem + '"]').addClass('active'); // Add the active class to the stored item
     }
   
     // Attach a click event handler to all anchor tags inside the 'mobile' class
     $('.mobile a').on('click', function(e) {
       e.preventDefault();
    
       $('.mobile a').removeClass('active'); // Remove the active class from all items
       $(this).addClass('active'); // Add the active class to the clicked item
   
       // Store the clicked item in session storage
       sessionStorage.setItem('activeItem', $(this).attr('href'));
   
       // Navigate to the link URL
       window.location.href = $(this).attr('href');
     });
    });
    </script>
   
             
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                   <span class="">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
               </a>
               <div class="dropdown-menu dropdown-menu-right">
                   @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                   <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                       {{ $properties['native'] }}
                   </a>
                   @endforeach
               </div>
           </li>

            <div class="language-menu ">
               <!-- language options -->
                

               <div class="menu">
                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50">
                     <path
                        d="M0 7.5L0 12.5L50 12.5L50 7.5 Z M 0 22.5L0 27.5L50 27.5L50 22.5 Z M 0 37.5L0 42.5L50 42.5L50 37.5Z"
                        fill="#fff"
                     />
                  </svg>
               </div>
            </div>
         </nav>
         <!-- / /////////////////////////// -->
      </header>

      <!-- start main -->
     @yield('body')
      <!-- end main -->

<!-- subscrip start -->
<div class="subscribe pt-5 pb-5 text-center text-md-start">
   <div class="container">
       <form action="{{ route('subscribers.store') }}" method="POST" class="row align-items-center">
         @csrf
         <div class="col-md-6 col-lg-3">
             <div class="fw-bold fs-5 mb-3"> كن اول من يعلم
               اشترك في النشرة الإخبارية لدينا للحصول على اخر الاخبار في صندوق الوارد الخاص بك! </div>
         </div>
         <div class="col-mg-6 col-lg-7 mb-5">
             <input class="" type="email" name="email" placeholder="ادخل بريدك هنا" required>
         </div>
         <div class="col-md-6 col-lg-2">
           <input class="btn rounded-pill" type="submit" value="اشترك الان">
       </div>
       </form>

   </div>
</div>
<!-- subscrip start -->

      <!-- start footer -->
      <footer>
         <div class="container1">
            <div class="top-footer">
               <div class="logo-foot">
                  <a href="{{Route('index')}}" >
                     <img src="{{ asset($setting->logo) }}" alt="" style="height: 70px">
                 </a>
                  <h2>{{$setting->translate(app()->getlocale())->title}}</h2>
                  <p>   {{ $setting->translate(app()->getlocale())->content }}    </p>
               </div>
               <div class="departments">
                  <h3>{{trans('words.categories')}}</h3>
                  <div class="depart-list">
                     <ul>
                       @if(count($categories) > 0)
                       @foreach ($categories as $key => $category)
                        <li>
                           <a href="{{Route('category',$category->id)}}" >
                              <span>
                                 <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160zm352-160l-160 160c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L301.3 256 438.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0z"/></svg>
                              </span>
                              <span>{{ $category->title }} </a></span> 
                        </li>
                        @endforeach
                        @endif
                        
                     </ul>
                  </div>
               </div>
               <div class="contact-us">
                  <h3> {{trans('words.contact us')}}</h3>
                  <ul>
                     <li>
                        <a href="{{$setting->facebook}}">
                           <span>
                              <i class="fa-brands fa-facebook"></i>
                           </span>
                           <span>{{trans('words.facebook')}}</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{$setting->instagram}}">
                           <span>
                              <i class="fa-brands fa-instagram"></i>
                           </span>
                           <span>{{trans('words.instagram')}}</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{$setting->phone}}">
                           <span>
                              <i class="fa-solid fa-phone"></i>
                           </span>
                           <span>{{trans('words.phone')}}</span>
                        </a>
                     </li>
                     <li>
                        <a href="{{$setting->email}}">
                           <span>
                              <i class="fa-regular fa-envelope"></i>
                           </span>
                           <span>{{trans('words.email')}}</span>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
            <div class="copy-right">
               <span>جميع الحقوق محفوظة © 2024 موقع تعز برس</span>
            </div>
            <a href="https://tecchnicaleducationofficetaize.on.drv.tw/Nasserportofolio/" target="_blank"> <span class="text-left">  developed by: Nasser alabbasi
               &copy; 2024.
           </span></a>
         </div>
      </footer>
      <!-- end footer -->

      <script src="{{asset('front2/js/main.js')}}" defer></script>
      {{-- <script   src="{{asset('front2/js/all.min.js')}}">
      <script   src="{{asset('front2/js/bootstrap.min.js')}}">
      <script   src="{{asset('front2/js/bootstrap.min.js.map')}}"> --}}
      <script src="{{ asset('adminassets/js/libs/jquery.min.js') }}"></script>
      <script src="{{ asset('adminassets/js/libs/tether.min.js') }}"></script>
      <script src="{{ asset('adminassets/js/libs/bootstrap.min.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/clipboard@^2.0.8/dist/clipboard.min.js"></script>
      
   </body>
</html>
