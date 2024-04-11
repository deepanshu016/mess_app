<?php

namespace App\Traits;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use App\Models\City;
trait UtilsTrait
{
    public function getUserLocationPreferences($user){
        $user_location_preferences = [];
        if (!$user->hasRole('ADMIN') && !$user->hasRole('MESS_OWNER') && !$user->hasRole('CUSTOMER')) {
            $locationList = $user->locationPreferences->pluck('locations')->toArray();
            if($user->level_type === 'country'){
                $countryList = Country::whereIn('id',$locationList)->pluck('id')->toArray();
                if(empty($countryList)){
                    return $user_location_preferences;
                }
                $stateList = State::whereIn('country_id',$countryList)->pluck('id')->toArray();
                if(empty($stateList)){
                    return $user_location_preferences;
                }
                $user_location_preferences = City::whereIn('state_id',$stateList)->pluck('id')->toArray();
                return $user_location_preferences;
            }else if($user->level_type === 'state'){
                $stateList = State::whereIn('id',$locationList)->pluck('id')->toArray();
                if(empty($stateList)){
                    return $user_location_preferences;
                }
                $user_location_preferences = City::whereIn('state_id',$stateList)->pluck('id')->toArray();
                return $user_location_preferences;
            }else{
                $user_location_preferences = City::whereIn('id',$locationList)->pluck('id')->toArray();
                return $user_location_preferences;
            }
        }
    }
}
