@extends('layouts.app')

@section('content')
<h1 class="page_title">予約</h1>

<h2 class="store_title">{{ $store->store_name }}</h2>

<div class="container">
    <div class="row">
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
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2 mt-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('reservations.store', ['store' => $store->id]) }}">
                @csrf

                <div class="form-group mb-3 d-flex algin-items-center">
                    <div class="col-md-2">
                        <label for="reservation_date">予約日</label>
                    </div>
                    <div class="col-md-10">
                        <input type="date" name="reservation_date" id="reservation_date" class="form-control" value="{{ old('reservation_date') }}" required>
                    </div>
                </div>

                <div class="form-group mb-3 d-flex algin-items-center">
                    <div class="col-md-2">
                        <label for="reservation_time">予約時間</label>
                    </div>
                    <div class="col-md-10">
                        <select name="reservation_time" id="reservation_time" class="form-select" required>
                            @for ($hour = 10; $hour <= 24; $hour++)
                                <option value="{{ sprintf('%02d:00', $hour) }}" {{ old('reservation_time') == sprintf('%02d:00', $hour) ? 'selected' : '' }}>
                                    {{ sprintf('%02d:00', $hour) }}
                                </option>
                                <option value="{{ sprintf('%02d:30', $hour) }}" {{ old('reservation_time') == sprintf('%02d:30', $hour) ? 'selected' : '' }}>
                                    {{ sprintf('%02d:30', $hour) }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3 d-flex algin-items-center">
                    <div class="col-md-2">
                        <label for="number_of_people">人数</label>
                    </div>
                    <div class="col-md-10">
                        <select name="number_of_people" id="number_of_people" class="form-select" required>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ old('number_of_people') == $i ? 'selected' : '' }}>
                                    {{ $i }}人
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3 d-flex algin-items-center">
                    <div class="col-md-2">
                        <label for="note">備考（任意）</label>
                    </div>
                    <div class="col-md-10">
                        <textarea name="note" id="note" class="form-control" rows="4" placeholder="アレルギーや特記事項、20名以上のご予約など">{{ old('note') }}</textarea>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn">予約する <i class="fa-solid fa-angle-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<a href="{{ route('stores.show', ['store' => $store->id]) }}" class="btn btn-back mt-4"><i class="fa-solid fa-angle-left"></i> もどる</a>
@endsection
