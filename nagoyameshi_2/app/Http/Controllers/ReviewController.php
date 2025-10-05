<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class ReviewController extends Controller
{
   
    public function show(Store $store) {
        $reviews = $store->reviews()->latest()->sortable()->paginate(12);

        $average_score = number_format($store->reviews()->avg('score'), 1);

        $review_count = $store->reviews()->count();

        return view('reviews.show', compact('store', 'reviews', 'average_score', 'review_count'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
            'score' => 'required|integer|min:1|max:5'
        ]);

        $review = new Review();
        $review->content = $request->input('content');
        $review->store_id = $request->input('store_id');
        $review->user_id = Auth::user()->id;
        $review->score = $request->input('score');
        $review->save();

        return redirect()->route('reviews.show', ['store' => $review->store_id])->with('success', 'レビューを投稿しました。');
    }


    public function edit(Store $store, Review $review) {
 
        return view('reviews.edit', compact('store', 'review'));
    }


    public function update(Request $request, Store $store, Review $review) {

        $request->validate([
            'content' => 'required',
            'score' => 'required|integer|min:1|max:5'
        ]);

        $review->score = $request->input('score');
        $review->content = $request->input('content');
        $review->save();

        return redirect()->route('reviews.show', ['store' => $review->store_id])->with('success', 'レビューを更新しました。');
    }


    public function destroy (Store $store, Review $review) {
 
        $review->delete();

        return redirect()->route('reviews.show', ['store' => $review->store_id])->with('success', 'レビューを削除しました。');
    }
}
