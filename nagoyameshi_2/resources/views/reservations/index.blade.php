@extends('layouts.app')

@section('content')
<h1 class="page_title" style="background-image: url('{{ asset('storage/images/reservation.png') }}">予約一覧</h1>

<div class="container text-center">
    @if (session('success'))
        <div class="alert alert-success mt-5 mb-1 w-100 text-start">
            {{ session('success')}}
        </div>
    @endif
    <p class="m-5 text-start">現在の予約数は <strong style="font-size: 25px;">{{ $reservations_count }}</strong> 件です。</p>
    <div class="row justify-content-center">
        @if ($reservations_count > 0)
            <div class="col-md-9 mx-auto">
                @foreach ($reservations as $reservation)
                    <div class="row mb-4 p-3 reservation-info" style="position: relative; min-height: 250px;">
                        <div class="col-md-5 mx-auto">
                            <a href="{{ route('stores.show', ['store' => $reservation->store->id]) }}" class="text-decoration-none text-dark">
                                <img src="{{ asset('storage/' . $reservation->store->image) }}" class="img-fluid m-2" style="width:200px; height: auto; object-fit: cover;" alt="店舗写真{{ $reservation->store->store_name }}">
                                <p class="reservation_store_info">
                                    <span style="font-weight: bold;">{{ $reservation->store->store_name }}</span><br>
                                    <span>{{ $reservation->store->category->category_name }}</span>
                                    <span>　予算 {{ $reservation->store->price }}円</span>
                                </p>
                            </a>
                        </div>

                        <div class="col-md-7">
                            <div class="row mb-0 text-start">
                                <div class="col-4">
                                    <label>予約日</label>
                                </div>
                                <div class="col-8">
                                    <p>{{ \Carbon\Carbon::parse($reservation->reservation_date)->isoFormat('YYYY年M月D日（ddd）') }}</p>
                                </div>
                            </div>
                            <div class="row mb-0 text-start">
                                <div class="col-4">
                                    <label>予約時間</label>
                                </div>
                                <div class="col-8">
                                    <p>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('G時i分') }}</p>
                                </div>
                            </div>
                            <div class="row mb-0 text-start">
                                <div class="col-4">
                                    <label>予約人数</label>
                                </div>
                                <div class="col-8">
                                    <p>{{ $reservation->number_of_people }} 名</p>
                                </div>
                            </div>
                            <div class="row mb-0 text-start">
                                <div class="col-4">
                                    <label>備考</label>
                                </div>
                                <div class="col-8">
                                    @if ($reservation->note == null)
                                        <p>記載なし</p>
                                    @else    
                                        <p>{{ $reservation->note }}</p>
                                    @endif
                                </div>
                            </div>

                            <!-- 🔻 右下に削除ボタン配置 -->
                            <form method="POST" action="{{ route('reservations.destroy', ['store' => $reservation->store->id, 'reservation' => $reservation->id]) }}" style="position: absolute; bottom: 0px; right: 30px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="delete" class="btn delete-btn-reservation" onclick="return confirm('本当に予約のキャンセルを行いますか？')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="col-12 text-center">
                <p style="font-size: 20px">現在のご予約はありません。</p>
                <p class="mt-2">気になるお店を見つけて、どんどん予約してみよう！</p>
            </div>
        @endif
    </div>
</div>

<div class="ms-5">
    {{ $reservations->links() }}
</div>

<a href="{{ route('stores.index') }}" class="btn btn-back mt-5"><i class="fa-solid fa-angle-left"></i>もどる</a>
@endsection