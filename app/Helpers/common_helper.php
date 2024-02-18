<?php


use \App\Models\Settings;
use \App\Models\MessOwner;
use \App\Models\User;
use \App\Models\Payment;
use \App\Models\CustomerMenu;

if (!function_exists('setting')) {
    function setting()
    {
        $setting = \App\Models\Settings::find(1);
        return $setting;
    }
}
if (!function_exists('customer_wallet_balance')) {
    function customer_wallet_balance() {
        $messOwnerDetails = MessOwner::find(auth()->user()->mess_id);
        $user = User::find(auth()->user()->id);
        $customerPayment = Payment::where('user_id',auth()->user()->id)->get();
        $customerMenu= CustomerMenu::where('user_id',auth()->user()->id)->first();
    }
}
?>
