<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            {{ config('app.name') }}
        </a>

        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ active_link('home') }}" aria-current="page">
                        {{ __('Главная') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('blog') }}" class="nav-link {{ active_link('blog*') }}" aria-current="page">
                        {{ __('Блог') }}
                    </a>
                </li>

                @can('view', App\Models\User::class)
                <li class="nav-item">
                    <a href="{{ route('admin.panel') }}" class="nav-link {{ active_link('admin.panel*') }}" aria-current="page">
                        {{ __('Панель') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('ability.index') }}" class="nav-link {{ active_link('ability.index*') }}" aria-current="page">
                        {{ __('Доступы') }}
                    </a>
                </li>    
                @endcan
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                @if(Auth::check())
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ active_link('register') }}" aria-current="page">
                        Привет, {{ Auth::user()->name }}    
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link {{ active_link('logout') }}" aria-current="page">
                        {{ __('Выход') }}    
                    </a> 
                </li>
                @else
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link {{ active_link('register') }}" aria-current="page">
                        {{ __('Регистрация') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link {{ active_link('login') }}" aria-current="page">
                        {{ __('Вход') }}
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
