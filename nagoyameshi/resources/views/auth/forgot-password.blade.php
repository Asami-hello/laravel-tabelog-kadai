@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-5">
           <h3 class="mt-3 mb-3">パスワード再設定</h3>

           <p class="pb-4">
               ご登録時のメールアドレスを入力してください。<br>
               パスワード再発行用のメールをお送りします。
           </p>



           @if (session('status'))
           <div class="alert alert-success" role="alert">
               {{ session('status') }}
           </div>
           @endif


           <form method="POST" action="{{ route('password.email') }}">
               @csrf

               <div class="form-group">
                   <input id="email" type="email" class="form-control @error('email') is-invalid @enderror samuraimart-login-input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="メールアドレス">

                   @error('email')
                   <span class="invalid-feedback" role="alert">
                       <strong>メールアドレスが正しくない可能性があります。</strong>
                   </span>
                   @enderror
               </div>

               <div class="form-group text-center">
                   <button type="submit" class="btn">
                       送信 <i class="fa-solid fa-angle-right"></i>
                   </button>
               </div>
           </form>
       </div>
   </div>
</div>

<a href="{{ route('login') }}" class="btn btn-back mt-5"><i class="fa-solid fa-angle-left"></i>もどる</a>
@endsection