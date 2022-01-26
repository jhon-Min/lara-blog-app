<a href="{{ route($rn) }}" class="nav-link {{ route($rn) == request()->url() ? 'active': '' }} ari-current="page">{{ $slot }}</a>
