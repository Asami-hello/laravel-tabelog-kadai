<nav class="navbar navbar-expand-md navbar-light nagoyameshi-header-container">
    <div class="container">
        <a class="navbar-logo" href="{{ route('stores.index') }}">
            <img src="{{ asset('storage/images/logo.png') }}" alt="ロゴマーク" class="logo_img">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mr-5 mt-2">
                @guest
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-user"></i>ログイン</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('register') }}">新規登録</a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-heart"></i></a>
                    </li>
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('login') }}"><i class="fa-regular fa-calendar"></i></a>
                    </li>
                @else
                    <li class="nav-item mr-5">
                        <a class="nav-link" href="{{ route('mypage') }}"><i class="fa-solid fa-user"></i>マイページ</a>
                    </li>
                    @if (Auth::user()->status === 'premium_plan')
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="{{ route('reservations.index') }}"><i class="fa-regular fa-calendar"></i></a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link" href="{{ route('mypage.favorite') }}"><i class="fa-solid fa-heart"></i></a>
                        </li>
                    @else
                        <li class="nav-item mr-5">
                            <a class="nav-link free-nav-link" href="{{ route('subscription.create') }}"><i class="fa-regular fa-calendar"></i></a>
                        </li>
                        <li class="nav-item mr-5">
                            <a class="nav-link free-nav-link" href="{{ route('subscription.create') }}"><i class="fa-solid fa-heart"></i></a>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</nav>