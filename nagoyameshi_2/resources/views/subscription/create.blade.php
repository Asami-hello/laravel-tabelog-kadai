@extends('layouts.app')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "{{ $stripeKey }}";
    </script>
    <!-- ngrok終わったらもとに戻す -->
    <!-- <script src="{{ asset('js/stripe.js') }}"></script> -->
    <script src="/kadai_002/nagoyameshi/public/js/stripe.js"></script>
@endpush

@section('content')
<h1 class="page_title mb-5 text-center">有料会員プラン登録</h1>

    <div class="container nagoyameshi-container">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">

                @if (session('subscription_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('subscription_message') }}</p>
                    </div>
                @endif
                <h3 class="text-center mb-4">有料会員プランの内容</h3>
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

                <hr class="mt-5 mb-5">

                <h3 class="text-center m-5">クレジットカード情報</h3>

                <div class="alert alert-danger nagoyameshi-card-error" id="card-error" role="alert" style="display: none;">
                    <div class="m-0 p-1" id="error-list"></div>
                </div>

                <form id="card-form" action="{{ route('subscription.store') }}" method="post" class="text-center">
                    @csrf
                    <input type="hidden" name="paymentMethodId" id="paymentMethodId">
                    <div class="row justify-content-center">
                        <div class="col-md-3 text-start">
                            <label for="card-holder-name">カード名義人</label>
                        </div>
                        <div class="col-md-9">
                            <input class="nagoyameshi-card-holder-name w-100 mb-3" id="card-holder-name" type="text" placeholder="HANAKO YAMADA" required>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-3 text-start">
                            <label for="card-element">カード情報</label>
                        </div>
                        <div class="col-md-9">
                            <div class="nagoyameshi-card-element mb-4" id="card-element"></div>
                        </div>
                    </div>
                    <div class="container mb-5">
                        <div class="row d-flex justify-content-center">
                            <div class="col-auto">
                                <button type="submit" class="btn" id="card-button" data-secret="{{ $intent->client_secret }}">登録 <i class="fa-solid fa-angle-right"></i></button>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('mypage.show') }}" class="btn">キャンセル <i class="fa-solid fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    
                   
                </form>
            </div>
        </div>
    </div>

<a href="{{ url()->previous() }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>

@endsection
