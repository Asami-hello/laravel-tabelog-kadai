@extends('layouts.app')

@section('content')

<h1 class="page_title" style="background-color: #999">会員情報の編集</h1>
<h3 class="text-center mt-5 mb-4">会員情報</h3>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 mt-3 user-info">
            <form method="POST" action="{{ route('mypage.update') }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="_method" value="PUT">
                    <div class="row align-items-center">
                        <label for="name" class="col-md-4 col-form-label text-md-left">氏名</label>
                        <div class="col-8">
                            <input type="text" id="name" name="name" class="form-control info-edit-filed" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="email" class="col-md-4 col-form-label text-md-left">メールアドレス</label>
                        <div class="col-8">
                            <input type="email" id="email" name="email" class="form-control info-edit-filed" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="tel" class="col-md-4 col-form-label text-md-left">電話番号</label>
                        <div class="col-8">
                            <input type="text" id="tel" name="tel" class="form-control info-edit-filed" value="{{ $user->tel }}">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="postal_code" class="col-md-4 col-form-label text-md-left">郵便番号</label>
                        <div class="col-8">
                            <input type="text" id="postal_code" name="postal_code" class="form-control info-edit-filed" value="{{ $user->postal_code }}">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="address" class="col-md-4 col-form-label text-md-left">住所</label>
                        <div class="col-8">
                            <input type="text" id="address" name="address" class="form-control info-edit-filed" value="{{ $user->address }}" title="{{ $user->address }}">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <label for="status" class="col-md-4 col-form-label text-md-left">会員ステータス</label>
                        <div class="col-8">
                            <input type="text" id="status" class="form-control info-edit-filed read-only-field" value="{{ $user->status === 'paid' ? '有料会員' : '無料会員' }}" readonly}}">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-3 mb-5">
                    <div class="col-auto">
                        <button type="submit" class="btn">編集内容を登録 <i class="fa-solid fa-angle-right"></i></button>
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