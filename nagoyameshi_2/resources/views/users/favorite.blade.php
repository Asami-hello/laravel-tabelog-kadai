@extends('layouts.app')

@section('content')

<h1 class="page_title">お気に入り一覧</h1>
<div class="container mt-3">
    <div class="row justify-content-start">
        <p class="mt-2">お気に入り店舗数 <strong style="font-size: 25px;">{{ $favorite_stores->count() }}</strong> 件です。</p>
        @if (count($favorite_stores) > 0)
            @foreach ($favorite_stores as $favorite_store)
                <div class="col-md-4 mb-4">
                    <div class="favorite_card border p-2 rounded d-flex flex-column align-items-center text-center h-100 position-relative">
                        <!-- ハートボタン -->
                        <div class="position-absolute top-0 start-0 m-2">
                            @if (Auth::user()->favorite_stores()->where('store_id', $favorite_store->id)->exists())
                                <a href="{{ route('favorites.destroy', $favorite_store->id) }}" class="btn heart-btn" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form-{{ $favorite_store->id }}').submit(); confirm('お気に入りから削除しますか？')">
                                    <i class="fa-solid fa-heart"></i>
                                </a>
                                <form id="favorites-destroy-form-{{ $favorite_store->id }}" action="{{ route('favorites.destroy', $favorite_store->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            @else
                                <a href="{{ route('favorites.store', $favorite_store->id) }}" class="btn heart-btn" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                                <form id="favorites-store-form" action="{{ route('favorites.store', $favorite_store->id) }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @endif
                        </div>
                        <!-- その他 -->
                        <a href="{{ route('stores.show', $favorite_store->id) }}" class="favorite_link">
                            <h3 class="m-2">{{ $favorite_store->store_name }}</h3>
                            <p class="d-flex align-items-center justify-content-center m-2">
                                <span>{{ $favorite_store->category->category_name }}</span>
                                <span class="ms-3">目安 {{ $favorite_store->price }}円</span>
                            </p>
                            @if ($favorite_store->average_score !== null)
                                <p class="d-flex align-items-center justify-content-center m-2">
                                    <span>{{ number_format($favorite_store->average_score, 1) }}</span>
                                    <span class="ms-2">
                                        @for ($i = 0; $i < floor($favorite_store->average_score); $i++)
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @endfor
                                        @for ($i = floor($favorite_store->average_score); $i < 5; $i++)
                                            <i class="fa-solid fa-star text-muted"></i>
                                        @endfor
                                    </span>
                                </p>
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12 text-center">
                <p style="font-size: 20px">該当する店舗が見つかりませんでした。</p>
                <p class="mt-2">気になるお店を見つけて、どんどんお気に入りしてみよう！</p>
            </div>
        @endif
    </div>
</div>

<a href="{{ url()->previous() }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>
@endsection