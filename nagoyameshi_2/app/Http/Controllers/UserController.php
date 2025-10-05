<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Laravel\Cashier\Billable;

class UserController extends Controller
{

    public function mypage() {
        $user = Auth::user();

        return view('users.mypage', compact('user'));
    }


    
    public function show() {
        $user = Auth::user();

        return view('users.show', compact('user'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = Auth::user();

        $user->name = $request->input('name') ? $request->input('name') : $user->name;
        $user->email = $request->input('email') ? $request->input('email') : $user->email;
        $user->tel = $request->input('tel') ? $request->input('tel') : $user->tel;
        $user->postal_code = $request->input('postal_code') ? $request->input('postal_code') : $user->postal_code;
        $user->address = $request->input('address') ? $request->input('address') : $user->address;
        $user->update();

        return to_route('mypage.show')->with('flash_message', '会員情報を変更しました');
    }

    
    public function update_password(Request $request) {
        $validatedDate = $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();

        if ($request->input('password') == $request->input('password_confirmation')) {
            $user->password = bcrypt($request->input('password'));
            $user->update();
        } else {
            return to_route('mypage.edit_password');
        }

        return to_route('mypage.show')->with('flash_message', 'パスワードを変更しました。');
    }


    public function edit_password() {
        return view('users.edit_password');
    }


    public function favorite () {
        $user = Auth::user();

        $favorite_stores = $user->favorite_stores()->with('category', 'reviews')->get();

        foreach ($favorite_stores as $favorite_store) {
            $favorite_store->average_score = $favorite_store->reviews->avg('score');
        }

        return view('users.favorite', compact('favorite_stores'));
    }


    public function destroy (Request $request) {
        $user = $request->user();

        if ($user->subscribed('premium_plan')) {
            $user->subscription('premium_plan')->cancelNow();
        }

        $user->delete();

        return redirect('/')->with('flash_message', '退会が完了しました。ご利用ありがとうございました。');
    }

}
