@extends('layouts.app')

@section('content')

<h1 class="page_title">店舗一覧</h1>

<div class="container">
    <div class="col-12"> 
        @if (session('flash_message'))
            <div class="alert alert-success mt-5 mb-1 w-100">
                {{ session('flash_message')}}
            </div>
        @endif
        <form class="m-3 d-flex justify-content-center align-items-center" action="{{ route('stores.index') }}" method="GET" class="search-form" id="keyword-form">
            <input class="search-input center-placeholder" type="text" name="keyword" id="keyword-input" value="{{ old('keyword', $keyword) }}" placeholder="店舗検索">
            <input type="hidden" name="category" value="{{ $categoryId }}">
            <button type="submit" class="btn search-btn d-flex justify-content-center align-items-center"><i class="fas fa-search"></i></button>
        </form>

        <div class="d-flex flex-row gap-3 mb-4">
            <form action="{{ route('stores.index') }}" method="GET" id="category-form">
                <input type="hidden" name="keyword" value="{{ $keyword }}">

                <select name="category" onchange="document.getElementById('category-form').submit()" class="form-select rounded">
                    <option value="" selected>すべてのカテゴリー</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <form method="GET" action="{{ route('stores.index') }}">
                <select name="sort" id="sort" class="form-select rounded" onchange="this.form.submit()">
                    <option value="">並び替え</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>価格が安い順</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>価格が高い順</option>
                </select>
                <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                <input type="hidden" name="category" value="{{ request('category') }}">
            </form>
            
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @if (count($stores) > 0)
            @foreach ($stores as $store)
                <div class="col-md-4 mb-4">
                    <div class="store-card border p-2 rounded d-flex flex-column align-items-center text-center h-100">
                        <a href="{{ route('stores.show', $store->id) }}" class="store_link text-decoration-none">
                            <h3 class="m-2">{{ $store->store_name }}</h3>
                            <p class="d-flex align-items-center justify-content-center m-2">
                                <span>{{ $store->category->category_name }}</span>
                                <span class="ms-3">予算 {{ $store->price }}円</span>
                            </p>
                            @if ($store->average_score !== null)
                                <p class="d-flex align-items-center justify-content-center m-2">
                                    <span>{{ number_format($store->average_score, 1) }}</span>
                                    <span class="ms-2">
                                        @for ($i = 0; $i < floor($store->average_score); $i++)
                                            <i class="fa-solid fa-star text-warning"></i>
                                        @endfor
                                        @for ($i = floor($store->average_score); $i < 5; $i++)
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
            </div>
        @endif
    </div>
</div>

<div class="ms-5">
    {{ $stores->links() }}
</div>
@endsection