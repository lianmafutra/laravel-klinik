@if (isset($permission) && auth()->user()->getRoleName() != 'superadmin')
    @if (auth()->user()->hasAnyPermission($permission))
        <li class="nav-item menu-is-opening @if (isset($menu_open) && $menu_open == true) menu-open">
      @else
      {{ request()->is($active) ? 'menu-open' : '' }}"> @endif
          <a href="{{ $url }}"
            class="nav-link rippleJS {!! request()->is($active) ? 'active' : '' !!}">
            <i class="{{ $icon }} nav-icon"></i>
            <p>{{ $title }}</p>
            @if (isset($notif))
                {!! $notif ? '<span class="badge badge-info right">' . $notif . '</span>' : '' !!}
            @endif
            <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
                @foreach ($item['items'] as $item)
                    @include('admin.layouts.menu.menu-item', $item)
                @endforeach
            </ul>
        </li>
    @endif
@else
    <li class="nav-item  menu-is-opening @if (isset($menu_open) && $menu_open == true) menu-open">
   @else
   {{ request()->is($active) ? 'menu-open' : '' }}"> @endif
       <a href="{{ $url }}"
        class="nav-link rippleJS {!! request()->is($active) ? 'active' : '' !!}">
        <i class="{{ $icon }} nav-icon "></i>
        <p clas>{{ $title }}</p>
        @if (isset($notif))
            {!! $notif ? '<span class="badge badge-info right">' . $notif . '</span>' : '' !!}
        @endif
        <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">
            @foreach ($item['items'] as $item)
                @include('admin.layouts.menu.menu-item', $item)
            @endforeach
        </ul>
    </li>
@endif
