<?php
namespace App\Http\Services;

use App\Models\Menu;
use App\Models\MessOwner;
use App\Models\MarkDay;
use Illuminate\Support\Facades\DB;

class MenuService {

    public function menu(){
        $messOwner = Menu::all();
        return $messOwner;
    }
    public function list($request,$mess_id = ''){
        $food_type = $request->menu;
        if($mess_id){
            $messOwner = MessOwner::find($mess_id);
        }else{
            $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        }
        $menu['sunday'] = Menu::where('added_by',$messOwner->id)->where('day','Sun')->where('food_type',$food_type)->first();
        $menu['monday'] = Menu::where('added_by',$messOwner->id)->where('day','Mon')->where('food_type',$food_type)->first();
        $menu['tuesday'] = Menu::where('added_by',$messOwner->id)->where('day','Tue')->where('food_type',$food_type)->first();
        $menu['wednesday'] = Menu::where('added_by',$messOwner->id)->where('day','Wed')->where('food_type',$food_type)->first();
        $menu['thursday'] = Menu::where('added_by',$messOwner->id)->where('day','Thu')->where('food_type',$food_type)->first();
        $menu['friday'] = Menu::where('added_by',$messOwner->id)->where('day','Fri')->where('food_type',$food_type)->first();
        $menu['saturday'] = Menu::where('added_by',$messOwner->id)->where('day','Sat')->where('food_type',$food_type)->first();
        return $menu;
    }
    public function edit($menu_id){
        return Menu::find($menu_id);
    }
    public function store(Object $request){
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $menu = Menu::create(['added_by'=>$messOwner->id,'day'=>$request->day,'food_type'=>$request->food_type,'menu_type'=>$request->menu_type,'cuisine_id'=>$request->cuisine_id,'mess_detail_breakfast'=>$request->mess_detail_breakfast,'mess_detail_lunch'=>$request->mess_detail_lunch,'mess_detail_dinner'=>$request->mess_detail_dinner]);
        $menu = Menu::find($menu->id);
        if($request->hasFile('menu_template') && $request->file('menu_template')->isValid()){
            $menu->addMediaFromRequest('menu_template')->toMediaCollection('MENU_TEMPLATE');
        }
        return $menu;
    }
    public function update(Object $request){
        $messOwner = MessOwner::where('user_id',auth()->user()->id)->first();
        $menu = Menu::find($request->id);
        $m = $menu->update(['added_by'=>$messOwner->id,'day'=>$request->day,'menu_type'=>$request->menu_type,'cuisine_id'=>$request->cuisine_id,'mess_detail_breakfast'=>$request->mess_detail_breakfast,'mess_detail_lunch'=>$request->mess_detail_lunch,'mess_detail_dinner'=>$request->mess_detail_dinner]);
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
    public function StoreAbsentDay(Object $request){
        $markDay = MarkDay::create(['user_id'=>auth()->user()->id,'mess_id'=>auth()->user()->mess_id,'mark_date'=>date('Y-m-d',strtotime($request->mark_date))]);
        return $markDay;
    }
    public function markDays(Object $request){
        $listData = [];
        $searchValue = $request->query('search')['value'];
        $mark_day =  MarkDay::where('user_id',auth()->user()->id);
        $totalRecords = $mark_day->count();
        $mark_day = $mark_day->offset($request->input('start'))->limit($request->input('length'));
        $mark_day = $mark_day->get();
        $listData['draw'] = intval($request->input('draw'));
        $listData['recordsTotal'] = $totalRecords;
        $listData['recordsFiltered'] = $totalRecords;
        $listData['data'] = $mark_day;
        return $listData;
    }
 }


?>
