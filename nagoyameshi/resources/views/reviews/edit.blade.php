@extends('layouts.app')

@section('content')
<h1 class="page_title" style="background-image: url('{{ asset('storage/images/review.png') }}">店舗レビュー</h1>

<h2 class="store_title">{{ $store->store_name }}</h2>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div>
                <h3>レビューを編集する</h3>

                @error('content')
                        <strong class="text-danger mt-5 mb-5">レビュー内容を入力してください</strong>
                @enderror
                
                <form method="POST" action="{{ route('reviews.update', ['store' => $store->id, 'review' => $review->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group d-flex align-items-center">
                        <label for="score" class="mr-2 mb-0">評価</label>
                        <select name="score" id="score" class="form-select m-2 review-score-color w-auto">
                            <option value="5" class="review-score-color" {{ old('score', $review->score) == 5 ? 'selected' : '' }}>★★★★★</option>
                            <option value="4" class="review-score-color" {{ old('score', $review->score) == 4 ? 'selected' : '' }}>★★★★</option>
                            <option value="3" class="review-score-color" {{ old('score', $review->score) == 3 ? 'selected' : '' }}>★★★</option>
                            <option value="2" class="review-score-color" {{ old('score', $review->score) == 2 ? 'selected' : '' }}>★★</option>
                            <option value="1" class="review-score-color" {{ old('score', $review->score) == 1 ? 'selected' : '' }}>★</option>
                        </select>
                    </div>
                    <textarea name="content" class="form-control m-2" rows="8" placeholder="レビュー内容を入力してください">{{ old('content', $review->content) }}</textarea>
                    
                    <input type="hidden" name="store_id" value="{{ $store->id }}">
                    <div class="text-end">
                        <button type="submit" class="btn ml-2 mt-1">更新 <i class="fa-solid fa-angle-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<a href="{{ route('reviews.show', ['store' => $store->id]) }}" class="btn btn-back"><i class="fa-solid fa-angle-left"></i>もどる</a>

@endsection