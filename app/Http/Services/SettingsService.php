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
        // if($request->hasFile('site_logo') && $request->file('site_logo')->isValid()){
        //     $settings->clearMediaCollection('SITE_LOGO');
        //     $settings->addMedia($request->file('site_logo'))->storingConversionsOnDisk('local')->toMediaCollection('SITE_LOGO');
        // }
        // if($request->hasFile('site_favicon') && $request->file('site_favicon')->isValid()){
        //     $settings->clearMediaCollection('SITE_FAVICON');
        //     $settings->addMedia($request->file('site_logo'))->storingConversionsOnDisk('local')->toMediaCollection('SITE_FAVICON');
        // }
        // if($request->hasFile('site_banner') && $request->file('site_banner')->isValid()){
        //     $settings->clearMediaCollection('SITE_BANNER');
        //     $settings->addMedia($request->file('site_banner'))->storingConversionsOnDisk('local')->toMediaCollection('SITE_BANNER');
        // }
        return $settings;
    }
 }


?>
