@props(['routeName' => '','label'])
<li class="dropdown {{ $routeName == Route::current()->getName() ? 'active' : '' }}"><a href="{{ route($routeName) }}">{{$label}}</a>
</li>
