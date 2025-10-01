<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function index() {
        $reservations = Auth::user()->reservations()->with('store')->orderby('reservation_date', 'desc')->paginate(5);

        $reservations_count = $reservations->total();

        return view('reservations.index', compact('reservations', 'reservations_count'));
    }


    public function create(Store $store) {
        $average_score = round($store->reviews()->avg('score'), 1);
        
        return view('reservations.create', compact('store', 'average_score'));
    }


    public function store(Request $request, Store $store) {
        $request->validate([
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'number_of_people' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        Reservation::create([
            'user_id' => Auth::id(),
            'store_id' => $store->id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'number_of_people' => $request->number_of_people,
            'note' => $request->note,
        ]);

        return redirect()->route('reservations.index', $store)->with('success', '予約が完了しました。');
    }


    public function destroy(Store $store, Reservation $reservation) {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', '予約をキャンセルしました。');
    }
}
