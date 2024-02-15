<?php
namespace App\Http\Services;

use App\Models\Menu;
use App\Models\MessOwner;
use Illuminate\Support\Facades\Hash;
class MenuService {

    public function menu(){
        $messOwner = Menu::all();
        return $messOwner;
    }
    public function list($request){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $setting =  Menu::where(function ($query) use ($searchValue){
            $query->orWhere('day','like','%'. $searchValue . '%');
            $query->orWhere('menu_detail','like','%'. $searchValue . '%');
        });
        $totalRecords = $setting->count();
        $setting = $setting->offset($request->input('start'))->limit($request->input('length'));
        $setting = $setting->get();
        $listData['draw'] = intval($request->input('draw'));
        $listData['recordsTotal'] = $totalRecords;
        $listData['recordsFiltered'] = $totalRecords;
        $listData['data'] = $setting;
        return $listData;
    }
    public function edit($menu_id){
        return Menu::find($menu_id);
    }
    public function store(Object $request){
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $menu = Menu::create(['added_by'=>$messOwner->id,'day'=>$request->day,'menu_type'=>$request->menu_type,'menu_detail'=>$request->menu_detail]);
        $menu = Menu::find($menu->id);
        if($request->hasFile('menu_template') && $request->file('menu_template')->isValid()){
            $menu->addMediaFromRequest('menu_template')->toMediaCollection('MENU_TEMPLATE');
        }
        return $menu;
    }
    public function update(Object $request){
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $menu = Menu::find($request->menu_id);
        $m = $menu->update(['added_by'=>$messOwner->id,'day'=>$request->day,'menu_type'=>$request->menu_type,'menu_detail'=>$request->menu_detail]);
        if($request->hasFile('menu_template') && $request->file('menu_template')->isValid()){
            $menu->clearMediaCollection('MENU_TEMPLATE');
            $menu->addMedia($request->file('menu_template'))->storingConversionsOnDisk('local')->toMediaCollection('MENU_TEMPLATE');
        }
        return $m;
    }
    public function delete($id){
        $mess_owner = Menu::find($id);
        $mess_owner->clearMediaCollection('MENU_TEMPLATE');
        return $mess_owner->delete();
    }
 }


?>
