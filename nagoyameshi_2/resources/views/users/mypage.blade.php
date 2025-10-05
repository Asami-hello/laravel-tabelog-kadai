@extends('layouts.app')

@section('content')
<h1 class="page_title">マイページ</h1>

<div class="container">
    <div class="row">
        <div class="col-12 mypage-item-set">
            <a class="btn mypage-item" href="{{ route('mypage.show') }}"><i class="fa-solid fa-user"></i>　会員情報詳細</a>
            @if (Auth::user()->status === 'premium_plan')
                <a class="btn mypage-item" href="{{ route('mypage.favorite') }}"><i class="fa-solid fa-heart"></i>　お気に入り一覧</a>
                <a class="btn mypage-item" href="{{ route('reservations.index') }}"><i class="fa-regular fa-calendar"></i>　予約一覧</a>
            @else
                <a class="btn free-mypage-item" href="{{ route('subscription.create') }}"><i class="fa-solid fa-lock" style="font-size: 20px;"></i>　お気に入り一覧</a>
                <a class="btn free-mypage-item" href="{{ route('subscription.create') }}"><i class="fa-solid fa-lock" style="font-size: 20px;"></i>　予約一覧</a>
            @endif
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn mypage-item">
                    <span><i class="fa-solid fa-right-from-bracket"></i>　ログアウト</span>
                </button>
            </form>
        </div>
    </div>
</div>

<a href="{{ url()->previous() }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>
@endsection