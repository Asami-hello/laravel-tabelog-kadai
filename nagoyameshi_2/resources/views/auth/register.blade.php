@extends('layouts.app')

@section('content')
<h1 class="page_title title_img_register">新規会員登録</h1>


<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-5 mt-5">
           <form method="POST" action="{{ route('register') }}">
               @csrf
               <div class="form-group row">
                   <label for="name" class="col-md-5 col-form-label text-md-left">氏名<span class="required_mark">必須</span></label>

                   <div class="col-md-7">
                       <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="山田 花子">

                       @error('name')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                       @enderror
                   </div>
               </div>

               <div class="form-group row">
                   <label for="email" class="col-md-5 col-form-label text-md-left">メールアドレス<span class="required_mark">必須</span></label>

                   <div class="col-md-7">
                       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="nagoyameshi@example.com">

                       @error('email')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                       @enderror
                   </div>
               </div>

               <div class="form-group row">
                   <label for="postal_code" class="col-md-5 col-form-label text-md-left">郵便番号<span class="ml-1"></label>

                   <div class="col-md-7">
                       <input type="text" class="form-control" name="postal_code" placeholder="123-1234" value="{{ old('postal_code') }}">
                   </div>
               </div>

               <div class="form-group row">
                   <label for="address" class="col-md-5 col-form-label text-md-left">住所</label>

                   <div class="col-md-7">
                       <input type="text" class="form-control" name="address" placeholder="東京都千代田区千代田1-1" value="{{ old('address') }}">
                   </div>
               </div>

               <div class="form-group row">
                   <label for="tel" class="col-md-5 col-form-label text-md-left">電話番号<span class="required_mark">必須</span></label>

                   <div class="col-md-7">
                       <input type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" placeholder="03-1234-5678" value="{{ old('tel') }}">

                       @error('tel')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                       @enderror
                   </div>
               </div>

               <div class="form-group row">
                   <label for="password" class="col-md-5 col-form-label text-md-left">パスワード<span class="required_mark">必須</span></label>

                   <div class="col-md-7">
                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="password" autocomplete="new-password">

                       @error('password')
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                       </span>
                       @enderror
                   </div>
               </div>

               <div class="form-group row mb-3">
                   <label for="password-confirm" class="col-md-5 col-form-label text-md-left"></label>

                   <div class="col-md-7">
                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="password" autocomplete="new-password">
                   </div>
               </div>

               <div class="form-group text-center">
                   <button type="submit" class="btn">
                       アカウント作成 <i class="fa-solid fa-angle-right"></i>
                   </button>
               </div>

                <div class="form-group text-center">
                    <a class="btn btn-sub" href="{{ route('login') }}">
                        ログインはこちら >
                    </a>
                </div>

           </form>
       </div>
   </div>
</div>
<a href="{{ route('stores.index') }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>

@endsection