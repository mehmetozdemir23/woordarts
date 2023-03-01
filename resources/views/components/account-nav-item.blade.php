@props(['route_name' => '','label'=>''])
@php
    $route_name_array = explode('.', $route_name);
    if(count($route_name_array) < 3){
        $is_active = Str::is(Route::current()->getName(),$route_name);
    }
    else{

        $parent_route_name = implode('.', array_slice($route_name_array, 0, count($route_name_array) - 1));
        $is_active = Str::contains(Route::current()->getName(), $parent_route_name);
    }

@endphp
<li><a href="{{ route($route_name) ?? '#' }}" class="nav-link {{ $is_active ? 'active' : '' }}">{{$label}}</a></li>
