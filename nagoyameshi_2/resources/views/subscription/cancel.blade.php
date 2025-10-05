@extends('layouts.app')

@section('content')
<h1 class="page_title" style="background-color: #999">有料会員プラン解約</h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">

                <p class="mt-5 text-center">解約すると以下の特典を受けられなくなります。<br>本当に解約してもよろしいですか？</p>
                <div class="card mb-4">
                    <div class="card-header text-center">
                        有料会員プランの内容
                    </div>
                    <div class="card">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">・月額300円</li>
                            <li class="list-group-item">・お店のご予約・キャンセル可能</li>
                            <li class="list-group-item">・お好きな店舗をお気に入り登録</li>
                            <li class="list-group-item">・レビューの投稿・閲覧</li>
                        </ul>
                    </div>
                </div>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <form id="cardForm" action="{{ route('subscription.destroy') }}" method="post">
                                @csrf
                                @method('delete')
                                <div class="form-group">
                                    <button class="btn" onclick="return confirm('本当に解約しますか？')">解約  <i class="fa-solid fa-angle-right"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('mypage.show') }}" class="btn">キャンセル <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<a href="{{ route('mypage.show') }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>
@endsection