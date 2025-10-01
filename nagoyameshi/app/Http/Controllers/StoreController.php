<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Category;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category');
        $sort = $request->input('sort');

        $stores = Store::query();

        if (!$sort) {
            $stores->orderBy('updated_at', 'desc');
        }

        if ($keyword) {
            $stores->where(function ($query) use ($keyword) {
                $query->where('store_name', 'like', '%' . $keyword . '%')
                ->orWhere('store_description', 'like', '%' . $keyword . '%')
                ->orWhereHas('category', function ($q) use ($keyword) {
                    $q->where('category_name', 'like', '%' . $keyword . '%');
                });
            });
        }

        if ($categoryId) {
            $stores->where('category_id', $categoryId);
        }

        if ($sort === 'price_asc') {
            $stores->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $stores->orderBy('price', 'desc');
        }

        $stores = $stores->sortable()->paginate(12);

        foreach ($stores as $store) {
            $store->average_score = round($store->reviews()->avg('score'), 1);
        }
        
        $categories = Category::all();
        

        return view('stores.index', compact('stores', 'keyword', 'categories', 'categoryId'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $average_score = round($store->reviews()->avg('score'), 1);

        $review_count = $store->reviews()->count();

        return view('stores.show', compact('store', 'average_score', 'review_count'));
    }

}
