<?php
namespace App\Http\Services;

use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class CommonService {

    public function getCountries(){
        $country = Country::orderBy('name','ASC')->get();
        return $country;
    }
    public function getStateList($country_id){
        $states = State::where('country_id',$country_id)->orderBy('name','ASC')->get();
        return $states;
    }
    public function getCityList($state_id){
        $cities = City::where('state_id',$state_id)->orderBy('name','ASC')->get();
        return $cities;
    }

    public function record_transaction($user_id,$mess_id,$transaction_type,$transaction_tag,$transaction_date,$amount,$balance){

        $transaction = Transaction::create(
            [
                'user_id' => $user_id,
                'mess_id' => $mess_id,
                'transaction_type' => $transaction_type,
                'transaction_tag' => $transaction_tag,
                'amount' => $amount,
                'balance' => $balance,
                'transaction_date' => ($transaction_date != '') ? date('Y-m-d',strtotime($transaction_date)) : date('Y-m-d'),
            ]
        );
        return $transaction;
    }
 }


?>
