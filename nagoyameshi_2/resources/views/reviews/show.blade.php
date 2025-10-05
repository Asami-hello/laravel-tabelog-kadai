@extends('layouts.app')

@section('content')
<h1 class="page_title" style="background-image: url('{{ asset('storage/images/review.png') }}">店舗レビュー</h1>

<h2 class="store_title">{{ $store->store_name }}</h2>

<div class="container">
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success mt-3" >
                {{ session('success') }}
            </div>
        @endif
        <div class="col-12 m-3 d-flex flex-row">
            <div class="col-md-5 me-5">
                <img class="img-fluid store_show_img me-2 me-md-4" src="{{ asset('storage/' . $store->image) }}" alt="店舗写真{{ $store->store_name }}">
            </div>

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
                                {{ $average_score }}    
                                @for ($i = 0; $i < floor($average_score); $i++)
                                    <i class="fa-solid fa-star text-warning"></i>
                                @endfor
                                @for ($i = floor($average_score); $i < 5; $i++)
                                    <i class="fa-solid fa-star text-muted"></i>
                                @endfor
                            @else
                                レビューなし
                            @endif 
                        </td>
                    </tr>
                </table>
            </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div>
                <h3>レビューを投稿する</h3>

                @error('content')
                        <strong class="text-danger mt-5 mb-5">レビュー内容を入力してください</strong>
                @enderror
                
                <form method="POST" action="{{ route('reviews.store') }}">
                    @csrf
                    <div class="form-group d-flex align-items-center">
                        <label for="score" class="mr-2 mb-0">評価</label>
                        <select name="score" id="score" class="form-select m-2 review-score-color w-auto">
                            <option value="5" class="review-score-color">★★★★★</option>
                            <option value="4" class="review-score-color">★★★★</option>
                            <option value="3" class="review-score-color">★★★</option>
                            <option value="2" class="review-score-color">★★</option>
                            <option value="1" class="review-score-color">★</option>
                        </select>
                    </div>
                    <textarea name="content" class="form-control m-2" rows="8" placeholder="レビュー内容を入力してください"></textarea>
                    
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <div class="text-end">
                        <button type="submit" class="btn ml-2 mt-1">投稿 <i class="fa-solid fa-angle-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div>
                <h3 class="mb-3">レビューを見る（{{ $review_count }}件）</h3><p></p>
                

                @foreach ($reviews as $review)
                    <div class="review-set border p-2 rounded d-flex flex-column justify-content-start h-100 m-3 pt-4 ps-4 pe-4">
                        <p>
                            {{ number_format($review->score, 1) }}
                            @for ($i = 0; $i < $review->score; $i++)
                                <i class="fa-solid fa-star text-warning"></i>
                            @endfor
                        </p>
                        <p class="review-content">{{ $review->content }}</p>
                        <div class="d-flex justify-content-end text-start pe-3">
                            <div class="text-start" style="font-size: 12px;">
                                <p class="review-content mb-0">投稿者：{{ $review->user->name }}</p>
                                <p class="review-content">投稿日：{{ $review->created_at->format('Y年m月d日 H:i') }}</p>
                            </div>
                        </div>
                        @if ($review->user_id === Auth::id())
                            <div class="text-end">
                                <a href="{{ route('reviews.edit', ['store' => $store->id, 'review' => $review->id]) }}" class="btn delete-btn me-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form method="POST" action="{{ route('reviews.destroy', ['store' => $store->id, 'review' => $review->id]) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="delete" class="btn delete-btn" onclick="return confirm('本当にレビューを削除しますか？')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>

<a href="{{ route('stores.show', ['store' => $store->id]) }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>

@endsection