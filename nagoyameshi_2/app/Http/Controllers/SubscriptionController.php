<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Exceptions\IncompletePayment;


class SubscriptionController extends Controller
{
    public function create() {
        $user = Auth::user();

        $intent = Auth::user()->createSetupIntent();

        $stripeKey = env('STRIPE_KEY');

        return view('subscription.create', compact('intent', 'stripeKey'));
    }


    public function store(Request $request) {
       
        $user = $request->user();
        try {
            $user->newSubscription('premium_plan', env('STRIPE_PREMIUM_PLAN_PRICE_ID'))->create($request->paymentMethodId);

            $user->update(['status' => 'premium_plan']);

            return redirect()->route('home')->with('flash_message', '有料会員プランへの登録が完了しました。');

        } catch (IncompletePayment $exception) {
            // 支払い失敗時の処理（例：エラーメッセージ表示）
            return redirect()->route('subscription.create')->withErrors(['payment' => 'カード情報に問題があります。入力内容をご確認ください。']);
        }

    }


    public function edit() {
        $user = Auth::user();
        $intent = $user->createSetupIntent();
        
        return view('subscription.edit', compact('user', 'intent'));
    }


    public function update(Request $request) {
        $request->user()->updateDefaultPaymentMethod($request->paymentMethodId);

        return redirect()->route('mypage.show')->with('flash_message', 'カード情報を変更しました。');
    }


    public function cancel() {
        return view('subscription.cancel');
    }


    public function destroy(Request $request) {
        $user = $request->user();

        $user->subscription('premium_plan')->cancelNow();

        $user->update(['status' => 'free']);

        return redirect()->route('home')->with('flash_message', '有料会員プランを解約しました。');
    }
}
