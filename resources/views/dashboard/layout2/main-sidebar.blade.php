<!-- main-sidebar -->
		<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
		<aside class="app-sidebar sidebar-scroll">
			<div class="main-sidebar-header active">
				<a class="desktop-logo logo-light active" href="{{route('dashboard.index')}}"><img src="{{ asset($setting->logo) }}" class="main-logo" alt="logo"></a>
				<a class="desktop-logo logo-dark active" href="{{route('dashboard.index')}}"><img src="{{ asset($setting->logo) }}" class="main-logo dark-theme" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-light active" href="{{route('dashboard.index')}}"><img src="{{ asset($setting->logo) }}" class="logo-icon" alt="logo"></a>
				<a class="logo-icon mobile-logo icon-dark active" href="{{route('dashboard.index')}}"><img src="{{ asset($setting->logo) }}" class="logo-icon dark-theme" alt="logo"></a>
			</div>
			<div class="main-sidemenu">
				<div class="app-sidebar__user clearfix">
					<div class="dropdown user-pro-body">
						<div class="">
							<img alt="user-img" class="avatar avatar-xl brround" src="{{URL::asset('adminassets2/img/faces/6.jpg')}}"><span class="avatar-status profile-status bg-green"></span>
						</div>
						<div class="user-info">
							@if (auth()->user())
							<h4 class="font-weight-semibold mt-3 mb-0">{{ auth()->user()->name }}</h4>
							<span class="mb-0 text-muted">{{ auth()->user()->status }}</span>
							@endif
						</div>
					</div>
				</div>
				<ul class="side-menu">
					<li class="side-item side-item-category">Main</li>
					<li class="slide">
						<a class="side-menu__item" href="{{route('dashboard.index')}}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" ><path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/><path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg><span class="side-menu__label">{{ trans('words.dashboard')}}</span><span class="badge badge-success side-badge">1</span></a>
					</li>

					
					<li class="side-item side-item-category">{{ trans('words.categories') }}</li>
					@can('view', $setting)
				
					<li class="slide">
						<a class="side-menu__item"  href="{{ route('dashboard.category.create') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
							<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
						  </svg><span class="side-menu__label">{{ trans('words.add category') }}</span>
					   </a>
					</li>
					@endcan
					
					<li class="slide">
						<a class="side-menu__item"  href="{{ route('dashboard.category.index') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon"  viewBox="0 0 24 24" >
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M5 5h4v4H5zm10 10h4v4h-4zM5 15h4v4H5zM16.66 4.52l-2.83 2.82 2.83 2.83 2.83-2.83z" opacity=".3"/><path d="M16.66 1.69L11 7.34 16.66 13l5.66-5.66-5.66-5.65zm-2.83 5.65l2.83-2.83 2.83 2.83-2.83 2.83-2.83-2.83zM3 3v8h8V3H3zm6 6H5V5h4v4zM3 21h8v-8H3v8zm2-6h4v4H5v-4zm8-2v8h8v-8h-8zm6 6h-4v-4h4v4z"/>
						  </svg><span class="side-menu__label"> {{ trans('words.show categories') }}</span><span class="badge badge-warning side-badge">Hot</span></a>
					</li>
					
					{{-- ////////// --}}

                     {{-- POSTS  --}}
					<li class="side-item side-item-category"> {{ trans('words.posts') }} </li>
					<li class="slide">
						<a class="side-menu__item"  href="{{ route('dashboard.posts.create') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
							<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
						  </svg><span class="side-menu__label">{{ trans('words.add post') }}</span>
					   </a>
					</li>
					<li class="slide">
						<a class="side-menu__item"  href="{{ route('dashboard.posts.index') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/><path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/>
					      </svg>
						  <span class="side-menu__label">  {{ trans('words.show posts') }} </span>
					   </a>
					</li>

			
					{{-- USERS --}}
				 @can('view', $setting)
					<li class="side-item side-item-category">{{ trans('words.users') }}</a></li>
					<li class="slide">
						<a class="side-menu__item"  href="{{ route('dashboard.users.create') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24">
							<path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
						  </svg><span class="side-menu__label"> {{ trans('words.add user') }}</span>
					   </a>
					</li>

					<li class="slide">
						<a class="side-menu__item" data-toggle="slide" href="{{ route('dashboard.users.index') }}">
							<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
							  <path d="M0 0h24v24H0V0z" fill="none"/>
							  <path d="M12 2c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm0 2c3.92 0 6.99 1.96 8.6 4.9-1.62 1.74-3.94 3.1-8.6 3.1-4.67 0-6.99-1.36-8.6-3.1C5.01 15.96 8.08 14 12 14z" opacity=".3"/>
							</svg>
							<span class="side-menu__label">  {{ trans('words.show users') }}</span>
							<i class="angle fe fe-chevron-down"></i>
						  </a>
					</li>
			
					{{-- OTHERS --}}
					<li class="side-item side-item-category">OTHERS</a></li>

					{{-- SETTINGS --}}
				
					<li class="slide">
						<a class="side-menu__item"  href="{{ route('dashboard.settings') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" >
							<path d="M0 0h24v24H0V0z" fill="none"/><path d="M10.9 19.91c.36.05.72.09 1.1.09 2.18 0 4.16-.88 5.61-2.3L14.89 13l-3.99 6.91zm-1.04-.21l2.71-4.7H4.59c.93 2.28 2.87 4.03 5.27 4.7zM8.54 12L5.7 7.09C4.64 8.45 4 10.15 4 12c0 .69.1 1.36.26 2h5.43l-1.15-2zm9.76 4.91C19.36 15.55 20 13.85 20 12c0-.69-.1-1.36-.26-2h-5.43l3.99 6.91zM13.73 9h5.68c-.93-2.28-2.88-4.04-5.28-4.7L11.42 9h2.31zm-3.46 0l2.83-4.92C12.74 4.03 12.37 4 12 4c-2.18 0-4.16.88-5.6 2.3L9.12 11l1.15-2z" opacity=".3"/><path d="M12 22c5.52 0 10-4.48 10-10 0-4.75-3.31-8.72-7.75-9.74l-.08-.04-.01.02C13.46 2.09 12.74 2 12 2 6.48 2 2 6.48 2 12s4.48 10 10 10zm0-2c-.38 0-.74-.04-1.1-.09L14.89 13l2.72 4.7C16.16 19.12 14.18 20 12 20zm8-8c0 1.85-.64 3.55-1.7 4.91l-4-6.91h5.43c.17.64.27 1.31.27 2zm-.59-3h-7.99l2.71-4.7c2.4.66 4.35 2.42 5.28 4.7zM12 4c.37 0 .74.03 1.1.08L10.27 9l-1.15 2L6.4 6.3C7.84 4.88 9.82 4 12 4zm-8 8c0-1.85.64-3.55 1.7-4.91L8.54 12l1.15 2H4.26C4.1 13.36 4 12.69 4 12zm6.27 3h2.3l-2.71 4.7c-2.4-.67-4.35-2.42-5.28-4.7h5.69z"/>
						  </svg><span class="side-menu__label"> {{ trans('words.settings') }}</span>
					   </a>
					</li>
				 @endcan

				    {{-- TRASH --}}
					<li class="slide">
						<a class="side-menu__item"  href="{{ route('dashboard.trash') }}"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M6 19C6 20.105 6.895 21 7.895 21H16.105C17.105 21 18 20.105 18 19V6H6V19ZM8 9H16V14H8V9Z" fill="#333"/>
							<path d="M18.9 4.1V4C18.9 3.44771 18.6523 2.93659 18.2426 2.52676L15.8322 0.116079C15.4219 -0.283921 14.8781 -0.283921 14.4678 0.116079L12 2.08392L9.53223 -0.116079C9.12193 -0.283921 8.57807 -0.283921 8.16777 0.116079L5.75738 2.52676C5.34766 2.93659 5.1 3.44771 5.1 4V4.1H18.9Z" fill="#333"/>
						  </svg>
						  <span class="side-menu__label">  {{ trans('words.trash') }}</a></span>
					   </a>
					</li>
				</ul>
			</div>
		</aside>
<!-- main-sidebar -->
