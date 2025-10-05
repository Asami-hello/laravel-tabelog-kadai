@extends('layouts.app')

@section('content')
<h1 class="page_title" style="background-color: #999">店舗詳細</h1>

<h2 class="store_title">{{ $store->store_name }}</h2>

@if (session('success'))
    <div class="alert alert-success mt-3" >
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <div class="row">
        <div class="col-12 m-3 d-flex flex-row">

            <div class="col-md-7">
                <table class="store-show-info">
                    <tr>
                        <th>カテゴリー</th>
                        <td>{{ $store->category->category_name }}</td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td>{{ $store->postal_code }} {{ $store->address }}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>{{ $store->tel }}</td>
                    </tr>
                    <tr>
                        <th>営業時間</th>
                        <td>{{ $store->business_hours }}</td>
                    </tr>
                    <tr>
                        <th>定休日</th>
                        <td>{{ $store->holiday }}</td>
                    </tr>
                    <tr>
                        <th>価格帯</th>
                        <td>{{ $store->price }}円</td>
                    </tr>
                    <tr>
                        <th>店舗紹介</th>
                        <td>{{ $store->store_description }}</td>
                    </tr>
                    <tr>
                        <th>スコア</th>
                        <td>
                            @if ($average_score !== null)
                                {{ number_format($average_score, 1) }}    
                                @for ($i = 0; $i < floor($average_score); $i++)
                                    <i class="fa-solid fa-star text-warning"></i>
                                @endfor
                                @for ($i = floor($average_score); $i < 5; $i++)
                                    <i class="fa-solid fa-star text-muted"></i>
                                @endfor
                            @else
                                レビューなし
                            @endif
                            
                             ({{ $review_count }}件)
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 mb-3">
            <div class="d-flex flex-wrap">
                @if (Auth::user()->status === 'premium_plan')
                    <!-- お気に入りボタン -->
                    @if (Auth::user()->favorite_stores()->where('store_id', $store->id)->exists())
                        <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $store->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-favorite">
                                お気に入りを解除<i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                    @else
                        <form id="favorites-store-form" action="{{ route('favorites.store', $store->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn" style="font-size: 16px">
                                お気に入りに追加<i class="fa-regular fa-heart"></i>
                            </button>
                        </form>
                    @endif
                    <!-- 予約ボタン -->
                    <a href="{{ route('reservations.create', ['store' => $store->id]) }}" class="btn" style="font-size: 16px">予約する<i class="fa-solid fa-calendar"></i></a>
                    <!-- レビューボタン -->
                    <a href="{{ route('reviews.show', ['store' => $store->id]) }}" class="btn" style="font-size: 16px">レビュー<i class="fa-solid fa-comment"></i></a>
                @else
                    <!-- お気に入りボタン -->
                    <a href="{{ route('subscription.create') }}" class="btn free_btn" style="font-size: 16px">お気に入りに追加<i class="fa-regular fa-heart"></i></a>
                    <!-- 予約ボタン -->
                    <a href="{{ route('subscription.create') }}" class="btn free_btn" style="font-size: 16px">予約する<i class="fa-solid fa-calendar"></i></a>
                    <!-- レビューボタン -->
                    <a href="{{ route('subscription.create') }}" class="btn free_btn" style="font-size:16px">レビュー<i class="fa-solid fa-comment"></i></a>
                @endif
            </div>
        </div>
    </div>
</div>

<a href="{{ route('stores.index') }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>店舗一覧へもどる</a>

@endsection