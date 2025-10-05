@extends('layouts.app')

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripeKey = "{{ env('STRIPE_KEY') }}";
    </script>
    <script src="{{ asset('/js/stripe.js') }}"></script>
@endpush

@section('content')
<h1 class="page_title">クレジットカード情報の編集</h1>
<div class="container">
    <div class="row justify-content-center">
        <h3 class="mt-5 mb-4 text-center">登録済みのクレジットカード情報</h3>
        <div class="col-md-6">
            <div class="container mb-4">
                <div class="row mt-2 mb-2">
                    <div class="col-3">
                        <label for="card_type">カード種別</label>
                    </div>
                    <div class="col-9">
                        <input type="text" id="card_type" name="card_type" class="form-control read-only-field" value="{{ $user->pm_type }}" readonly>
                    </div>
                </div>

                <div class="row mt-2 mb-2">
                    <div class="col-3">
                        <label for="card_holder_name">カード名義人</label>
                    </div>
                    <div class="col-9">
                        <input type="text" id="card_holder_name" name="card_holder_name" class="form-control read-only-field" value="{{ $user->defaultPaymentMethod()->billing_details->name  }}" readonly>
                    </div>
                </div>

                <div class="row mt-2 mb-2">
                    <div class="col-3">
                        <label for="cart_number">カード番号</label>
                    </div>
                    <div class="col-9">
                        <input type="text" id="card_number" name="card_number" class="form-control read-only-field" value="**** **** **** {{ $user->pm_last_four }}" readonly>
                    </div>
                </div>
            </div>
            <hr class="mt-5">
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <h3 class="mt-5 mb-4 text-center">編集内容</h3>
            <div class="container  mb-4">
                <div class="row  mt-2 mb-2">
                    <div class="col-md-3">
                        <label for="card_holder_name">カード名義人</label>
                    </div>
                    <div class="col-md-9">
                        <form id="card-form" action="{{ route('subscription.update') }}" method="post">
                            @csrf
                            @method('patch')
                            <input type="text" class="nagoyameshi-card-holder-name mb-3 w-100" id="card-holder-name" placeholder="カード名義人" required>
                        </form>
                        <div class="alert alert-danger nagoyameshi-card-error" id="card-error" role="alert" style="display: none;">
                            <ul class="mb-0" id="error-list"></ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="card_info">カード情報</label>
                    </div>
                    <div class="col-md-9">
                        <div class="nagoyameshi-card-element mb-4" id="card-element"></div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="col-auto">    
                            <button class="btn" id="card-button" data-secret="{{ $intent->client_secret }}">変更 <i class="fa-solid fa-angle-right"></i></button>
                        </div>
                        <div class="col-auto ms-2">
                            <a href="{{ route('mypage.show') }}" class="btn">キャンセル <i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>




                

                
                
            </div>
        </div>
    </div>
@endsection