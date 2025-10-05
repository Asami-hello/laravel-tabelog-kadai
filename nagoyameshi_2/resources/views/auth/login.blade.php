@extends('layouts.app')

@section('content')
<h1 class="mb-1 page_title">ログイン</h3>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 mt-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email')}}
                    </div>
                @endif

               <div class="form-group row">
                    <label for="email" class="col-md-5 col-form-label text-md-left">メールアドレス</label>
                    
                    <div class="col-md-7">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nagoyameshi@example.com">
                    </div>

                   @error('email')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                   @enderror
               </div>

               <div class="form-group row">
                   <label for="email" class="col-md-5 col-form-label text-md-left">パスワード</label>

                    <div class="col-md-7">
                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">
                    </div>

                   @error('password')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                   @enderror
               </div>

               <div class="form-group row">
                   <div class="form-check">
                       <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                       <label class="form-check-label nagoyameshi-check-label" for="remember">
                           次回から自動的にログインする
                       </label>
                   </div>
               </div>

               <div class="form-group text-center">
                   <button type="submit" class="btn mx-auto d-block">
                       ログイン <i class="fa-solid fa-angle-right"></i>
                   </button>
               </div>
            </form>

           <div class="form-group text-center">
               <a class="btn btn-sub" href="{{ route('password.request') }}">
                   パスワードをお忘れの場合はこちら >
               </a><br>
               <a class="btn btn-sub" href="{{ route('register') }}">
                   新規登録がお済でない方はこちら >
               </a>
           </div>
       </div>
   </div>
</div>
<div class="mt-3 text-right">
    <a class="btn admin_login_btn" href="http://nagoyameshi-imasa-81b4039f351b.herokuapp.com/admin/auth/login">
        <i class="fa-solid fa-book-open-reader" style="font-size: 20px"></i>
        <p>管理者用<br>ログイン</p> 
    </a>
</div>
<a href="{{ route('stores.index') }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>

@endsection