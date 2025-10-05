@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-5">
           <h3 class="text-center mt-5">会員登録ありがとうございます！</h3>

           <p class="text-center mt-5 mb-1">
               ただいま、ご入力いただいたメールアドレス宛に、
           </p>

           <p class="text-center m-1">
               ご本人様確認用のメールをお送りしました。
           </p>

           <p class="text-center m-0">
               メール本文内のURLをクリックすると本会員登録が完了します。
           </p>

           <p class="text-center mt-5 mb-5">
               Nagoyameshiで名古屋グルメをお楽しみください！
           </p>
           <div class="text-center mt-4">
               <a href="{{ url('/') }}" class="btn">トップページへ <i class="fa-solid fa-angle-right"></i></a>
           </div>
       </div>
   </div>
</div>
@endsection