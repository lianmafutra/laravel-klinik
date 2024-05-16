<aside class="main-sidebar sidebar-dark-primary ">
    <a href="" class="brand-link">
        <img src="{{ asset('img/' . Cache::store('styles')->get('header_logo', 'img/logo_laravel.jpeg')) }}"
            alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          
        <span class="brand-text font-weight-light">{{ Cache::store('styles')->get('app_name', 'starter_app') }}
      
      </span>
       
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy nav-compact"
                data-widget="treeview" role="menu" data-accordion="false">
                @foreach ($menu as $item)
                    @switch($item['type'])
                        @case('header')
                            @include('admin.layouts.menu.menu-header', $item)
                        @break

                        @case('tree')
                            @include('admin.layouts.menu.menu-tree', $item)
                        @break

                        @case('menu')
                            @include('admin.layouts.menu.menu-item', $item)
                        @break
                    @endswitch
                @endforeach
            </ul>
        </nav>
    </div>
</aside>
