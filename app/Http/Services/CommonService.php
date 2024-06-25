<?php
namespace App\Http\Services;

use App\Models\User;
use App\Models\Country;
use App\Models\State;
use App\Models\MessOwner;
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

    public function getProfile($relation=[]){
        $user = User::with($relation)->find(auth()->user()->id);
        return $user;
    }
    public function listForAdmin($userDetails,$request,$locationPreferences){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $user = User::with(['mess_owner'])->whereHas('roles', function ($query) {
            $query->where('name', 'CUSTOMER');
        });
        if($request->mess_id){
            $user = $user->where('mess_id',$request->mess_id);
        }

        if(!$userDetails->hasRole('ADMIN')){
            $messDetails = MessOwner::whereIn('city_id',$locationPreferences)->pluck('id')->toArray();
            $user = $user->whereIn('mess_id',$messDetails);
        }
        $user = $user->where(function ($query) use ($searchValue){
            $query->whereHas('customer_menu',function($query) use ($searchValue){
                $query->where('meal_type','like','%'. $searchValue . '%');
            });
            $query->orWhere('name','like','%'. $searchValue . '%');
            $query->orWhere('email','like','%'. $searchValue . '%');
            $query->orWhere('phone','like','%'. $searchValue . '%');
        });
        $totalRecords = $user->count();
        $user = $user->offset($request->input('start'))->limit($request->input('length'));
        $user = $user->get();
        $listData['draw'] = intval($request->input('draw'));
        $listData['recordsTotal'] = $totalRecords;
        $listData['recordsFiltered'] = $totalRecords;
        $listData['data'] = $user;
        return $listData;
    }


    public function getAllMess($userDetails,$request,$locationPreferences){
        $mess = MessOwner::with('user');
        if(!$userDetails->hasRole('ADMIN')){
            $mess = $mess->whereIn('city_id',$locationPreferences);
        }
        return $mess->get();
    }
 }


?>
