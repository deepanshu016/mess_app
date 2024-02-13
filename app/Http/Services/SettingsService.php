<?php
namespace App\Http\Services;

use App\Models\Settings;
class SettingsService {

    public function list(){
        $setting =  Settings::find(1);
        return $setting;
    }
    public function store(Object $request){
        $settings =  Settings::find(1);
        if(!$settings){
            $settings = Settings::create($request->toArray());
        }else{
            $settings = $settings->update($request->toArray());
        }
        $settings =  Settings::find(1);
        if($request->hasFile('site_logo') && $request->file('site_logo')->isValid()){
            $settings->addMediaFromRequest('site_logo')->toMediaCollection('site_logo');
        }
        if($request->hasFile('site_favicon') && $request->file('site_favicon')->isValid()){
            $settings->addMediaFromRequest('site_favicon')->toMediaCollection('site_favicon');
        }
        if($request->hasFile('site_banner') && $request->file('site_banner')->isValid()){
            $settings->addMediaFromRequest('site_banner')->toMediaCollection('site_favicon');
        }
        return $settings;
    }
 }


?>
