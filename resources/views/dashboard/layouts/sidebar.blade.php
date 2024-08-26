<div class="sidebar" >
    <nav class="sidebar-nav">
        
        <ul class="nav">
          
            <li class="nav-item">
                <a class="nav-link" href="{{route('dashboard.index')}}"><i class="icon-speedometer"></i> {{ trans('words.dashboard') }}
                </a>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>
                    {{ trans('words.categories') }}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        @can('view', $setting)
                        <a class="nav-link" href="{{ route('dashboard.category.create') }}">
                            <i class="fas fa-plus"></i>{{ trans('words.add category') }}
                        </a>
                        @endcan
                        <a class="nav-link" href="{{ route('dashboard.category.index') }}">
                            <i class="fas fa-list"></i>
                            {{ trans('words.show categories') }}</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>
                    {{ trans('words.posts') }}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.posts.create') }}"> 
                            <i class="fas fa-plus"></i>  {{ trans('words.add post') }}</a>
                        <a class="nav-link" href="{{ route('dashboard.posts.index') }}">
                            <i class="fas fa-eye"></i>
                            {{ trans('words.show posts') }}</a>
                    </li>
                </ul>
            </li>

            @can('view', $setting)
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-puzzle"></i>
                        {{ trans('words.users') }}</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard.users.create') }}">
                                <i class="fas fa-plus"></i> {{ trans('words.add user') }}</a>
                            <a class="nav-link" href="{{ route('dashboard.users.index') }}">
                                <i class="fas fa-eye"></i>
                                {{ trans('words.show users') }}</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.settings') }}"> <i class="fas fa-cog"></i>
                        {{ trans('words.settings') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.trash') }}"> <i class="fa-solid fa-trash"></i>
                        {{ trans('words.trash') }}</a>
                </li>
            @endcan

            
        </ul>


    </nav>
</div>
