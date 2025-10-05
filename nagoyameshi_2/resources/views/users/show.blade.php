@extends('layouts.app')

@section('content')

<h1 class="page_title">会員情報詳細</h1>

<div class="container">
    <div class="row justify-content-center">
        @if (session('flash_message'))
            <div class="alert alert-success mt-5 mb-1 w-100">
                {{ session('flash_message')}}
            </div>
        @endif
        <div class="col-md-5 mt-3 user-info">
            <h3 class="text-center mt-5 mb-4"><i class="fa-solid fa-user"></i> 会員情報</h3>
            <div class="row align-items-center">
                <label for="name" class="col-md-4 col-form-label text-md-left">氏名</label>
                <div class="col-8">
                    <input type="text" id="name" name="name" class="form-control read-only-field" value="{{ $user->name }}" readonly>
                </div>
            </div>
            <div class="row align-items-center">
                <label for="email" class="col-md-4 col-form-label text-md-left">メールアドレス</label>
                <div class="col-8">
                    <input type="email" id="email" name="email" class="form-control read-only-field" value="{{ $user->email }}" readonly>
                </div>
            </div>
            <div class="row align-items-center">
                <label for="tel" class="col-md-4 col-form-label text-md-left">電話番号</label>
                <div class="col-8">
                    <input type="text" id="tel" name="tel" class="form-control read-only-field" value="{{ $user->tel }}" readonly>
                </div>
            </div>
            <div class="row align-items-center">
                <label for="postal_code" class="col-md-4 col-form-label text-md-left">郵便番号</label>
                <div class="col-8">
                    <input type="text" id="postal_code" name="postal_code" class="form-control read-only-field" value="{{ $user->postal_code }}" readonly>
                </div>
            </div>
            <div class="row align-items-center">
                <label for="address" class="col-md-4 col-form-label text-md-left">住所</label>
                <div class="col-8">
                    <input type="text" id="address" name="address" class="form-control read-only-field" value="{{ $user->address }}" readonly title="{{ $user->address }}">
                </div>
            </div>
            <div class="row align-items-center">
                <label for="status" class="col-md-4 col-form-label text-md-left">会員ステータス</label>
                <div class="col-8">
                    <input type="text" id="status" name="status" class="form-control read-only-field" 
                        value="{{ $user->status === 'premium_plan' ? '有料会員' : '無料会員' }}" readonly>
                </div>
            </div>
            <div class="text-center">
                <a href="{{ route('mypage.edit') }}" class="btn">会員情報の編集 <i class="fa-solid fa-angle-right"></i></a>
            </div>
        </div>

        <hr class="m-5">
            
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <h3><i class="fa-solid fa-key m-3"></i>パスワードの変更</h3>
                    <p class="mt-1">登録済みのパスワードの変更を行う場合はこちら</p>
                    <a href="{{ route('mypage.edit_password') }}" class="btn">パスワードの変更 <i class="fa-solid fa-angle-right"></i></a>
                </div>
            </div>

            <hr class="m-5">

            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <h3><i class="fa-solid fa-user-plus m-3"></i>有料会員プラン</h3>
                    @if (Auth::user()->status === 'premium_plan')
                        <p>有料会員プランの編集・解約をご希望の方はこちら</p>
                        <a href="{{ route('subscription.edit') }}" class="btn">カード情報の編集 <i class="fa-solid fa-angle-right"></i></a>

                        <a href="{{ route('subscription.cancel') }}" class="btn">解約する  <i class="fa-solid fa-angle-right"></i></a>
                    @else                  
                        <p>有料会員プランへの加入をご希望の方はこちら</p>
                        <a href="{{ route('subscription.create') }}" class="btn">加入する <i class="fa-solid fa-angle-right"></i></a>
                    @endif
                </div>
            </div>

            <hr class="m-5">

            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <h3><i class="fa-solid fa-door-open m-3"></i>退会</h3>
                    <p>Nagoyameshi会員の退会をご希望の方はこちら</p>
                    @if ($user->status === "premium_plan")
                        <p><strong>※ 有料会員プランにご加入の方は、まず有料会員プランをご解約ください。 ※</strong></p>
                        <a href="{{ route('subscription.cancel') }}" class="btn free_btn">退会する <i class="fa-solid fa-angle-right"></i></a>
                    @else
                        <form action="{{ route('mypage.delete') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" onclick="return confirm('nagoyameshi会員を本当に退会しますか？')">
                                退会する <i class="fa-solid fa-angle-right"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>

    </div>
</div>


<a href="{{ route('mypage') }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>
@endsection