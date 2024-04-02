<?php


use \App\Models\Settings;
use \App\Models\MessOwner;
use \App\Models\User;
use \App\Models\Payment;
use \App\Models\Banner;
use \App\Models\Attendance;
use \App\Models\Country;
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


if (!function_exists('count_total_attend_days')) {
    function count_total_attend_days($customer_id,$mess_id) {
        $totalSpend = 0;
        $customerData = User::with(['customer_menu','payments','attendances'])->find($customer_id);
        $messOwnerData = MessOwner::find($mess_id);
        $totalRemainingAmount = $customerData->payment;
        if(!empty($customerData) && !empty($customerData->customer_menu) && !empty($customerData->payments) && !empty($messOwnerData)){
            if($customerData->customer_menu->meal_type == 'veg'){
                if($customerData->customer_menu->breakfast){
                    $breakFastPerDay = ($messOwnerData->veg_breakfast_price / 30);
                    $totalSpend = $totalSpend + $breakFastPerDay;
                }
                if($customerData->customer_menu->lunch){
                    $lunchFastPerDay = ($messOwnerData->veg_lunch_price / 30);
                    $totalSpend = $totalSpend + $lunchFastPerDay;
                }
                if($customerData->customer_menu->dinner){
                    $dinnerFastPerDay = ($messOwnerData->veg_dinner_price / 30);
                    $totalSpend = $totalSpend + $dinnerFastPerDay;
                }
            }else {
                if($customerData->customer_menu->breakfast){
                    $breakFastPerDay = ($messOwnerData->non_veg_breakfast_price / 30);
                    $totalSpend += $totalSpend + $breakFastPerDay;
                }
                if($customerData->customer_menu->lunch){
                    $lunchFastPerDay = ($messOwnerData->non_veg_lunch_price / 30);
                    $totalSpend += $totalSpend + $lunchFastPerDay;
                }
                if($customerData->customer_menu->dinner){
                    $dinnerFastPerDay = ($messOwnerData->non_veg_dinner_price / 30);
                    $totalSpend += $totalSpend + $dinnerFastPerDay;
                }
            }
            $totalDays = count($customerData->attendances);
            $totalSpendAmount = ($totalSpend * $totalDays);
            $totalRemainingAmount = $customerData->payment - $totalSpendAmount;
        }
        return $totalRemainingAmount;
    }
}

if (!function_exists('date_difference')) {
    function date_difference($date1,$date2) {
        $interval = $date1->diff($date2);
        $daysDifference = $interval->days;
        return $daysDifference;
    }
}
if (!function_exists('getTotalPerDay')) {
    function getTotalPerDay($customer_id,$mess_id,$meal_type) {
        $totalSpend = 0;
        $customerData = User::with(['customer_menu','payments','attendances'])->find($customer_id);
        $messOwnerData = MessOwner::find($mess_id);
        if(!empty($customerData) && !empty($messOwnerData) && !empty($meal_type)){
            if($customerData->meal_type == 'veg'){
                if(in_array('breakfast',$meal_type)){
                    $breakFastPerDay = ($messOwnerData->veg_breakfast_price / 30);
                    $totalSpend += $breakFastPerDay;
                }
                if(in_array('lunch',$meal_type)){
                    $lunchFastPerDay = ($messOwnerData->veg_lunch_price / 30);
                    $totalSpend += $lunchFastPerDay;
                }
                if(in_array('dinner',$meal_type)){
                    $dinnerFastPerDay = ($messOwnerData->veg_dinner_price / 30);
                    $totalSpend += $dinnerFastPerDay;
                }
            }else {
                if(in_array('breakfast',$meal_type)){
                    $breakFastPerDay = ($messOwnerData->non_veg_breakfast_price / 30);
                    $totalSpend += $breakFastPerDay;
                }
                if(in_array('lunch',$meal_type)){
                    $lunchFastPerDay = ($messOwnerData->non_veg_lunch_price / 30);
                    $totalSpend += $lunchFastPerDay;
                }
                if(in_array('dinner',$meal_type)){
                    $dinnerFastPerDay = ($messOwnerData->non_veg_dinner_price / 30);
                    $totalSpend += $dinnerFastPerDay;
                }
            }
        }
        return number_format($totalSpend,2);
    }
}

if (!function_exists('getMessOwner')) {
    function getMessOwner(){
        $user_id = auth()->user()->id;
        $messOwner = MessOwner::where('user_id',$user_id)->first();
        return $messOwner;
    }
}
if (!function_exists('mess_owner_list')) {
    function mess_owner_list(){
        $messOwner = MessOwner::all();
        return $messOwner;
    }
}
if (!function_exists('country_list')) {
    function country_list(){
        $country = Country::all();
        return $country;
    }
}
if (!function_exists('random_ads')) {
    function random_ads(){
        $randomAdvertisement = Banner::inRandomOrder()->first();
        return $randomAdvertisement;
    }
}
?>
