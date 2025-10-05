@extends('layouts.app')

@section('content')
<h1 class="page_title">パスワードを変更する</h1>

<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-5 mt-5">
            <form method="post" action="{{ route('mypage.update_password') }}">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-right">新しいパスワード</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">確認用</label>

                    <div class="col-md-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row justify-content-center mt-3 mb-5">
                    <div class="col-auto">
                        <button type="submit" class="btn">変更 <i class="fa-solid fa-angle-right"></i></button>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('mypage.show') }}" class="btn">キャンセル <i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
            </form>
        </div>
    </div>   
</div>

<a href="{{ route('mypage.show') }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>
@endsection