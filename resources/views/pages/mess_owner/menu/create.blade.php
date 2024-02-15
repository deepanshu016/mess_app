@extends('pages.layout.layout')
@section('title','Mess App | Manage Menu')
@section('content')
@section('page_styles')
<link href="https://www.tiny.cloud/css/codepen.min.css" />
@endsection
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($menu)) ? 'Add Menu' : 'Update Menu' }}</h2>
                </div>
                <div class="right-part">
                    <form class="search-form w-auto" action="https://wpthemebooster.com/demo/themeforest/html/kleon/search.php">
                        <input type="text" name="search" class=" bg-white form-control" placeholder="Search">
                        <button type="submit" class="btn"><img src="{{ asset('/') }}frontend/assets/img/svg/search.svg" alt=""></button>
                    </form>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Menu</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="menuForm" method="POST" action="{{ (empty($menu)) ? route('mess_owner.menu.save') : route('mess_owner.menu.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Day</label>
                            <select class="form-control" name="day">
                                <option value="">Select Day</option>
                                <option value="Mon" {{ (isset($menu) && $menu->day == 'MON') ? 'selected' : '' }}>Monday</option>
                                <option value="Tue" {{ (isset($menu) && $menu->day == 'TUE') ? 'selected' : '' }}>Tuesday</option>
                                <option value="Wed" {{ (isset($menu) && $menu->day == 'WED') ? 'selected' : '' }}>Wednesday</option>
                                <option value="Thur" {{ (isset($menu) && $menu->day == 'THUR') ? 'selected' : '' }}>Thursday</option>
                                <option value="Fri" {{ (isset($menu) && $menu->day == 'FRI') ? 'selected' : '' }}>Friday</option>
                                <option value="Sat" {{ (isset($menu) && $menu->day == 'SAT') ? 'selected' : '' }}>Saturday</option>
                                <option value="Sun" {{ (isset($menu) && $menu->day == 'SUN') ? 'selected' : '' }}>Sunday</option>
                            </select>
                            <input type="hidden" class="form-control" name="menu_id" value="{{ @$menu->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Menu Type</label>
                            <select class="form-control" name="menu_type">
                                <option value="">Select Menu Type</option>
                                <option value="breakfast" {{ (isset($menu) && $menu->menu_type == 'BREAKFAST') ? 'selected' : '' }}>Breakfast</option>
                                <option value="lunch" {{ (isset($menu) && $menu->menu_type == 'LUNCH') ? 'selected' : '' }}>Lunch</option>
                                <option value="dinner" {{ (isset($menu) && $menu->menu_type == 'DINNER') ? 'selected' : '' }}>Dinner</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Menu Template <small>(if any)</samll></label>
                            <input type="file" class="form-control" name="menu_template" accept="images/*">
                            @if(!empty($menu) && isset($menu->getMedia("MENU_TEMPLATE")[0]))
                                <img src="{{ asset('public/media/').'/'.$menu->getMedia("MENU_TEMPLATE")[0]->id.'/'.$menu->getMedia("MENU_TEMPLATE")[0]->file_name }}" width="100" height="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Menu Details</label>
                            <textarea class="form-control" name="menu_detail"  placeholder="Menu Details" maxlength="500">{{ @$menu->menu_detail}}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($menu)) ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@section('page_scripts')
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/6/tinymce.min.js"></script>
<script>
    $(function(){
        $("body").on('submit','#menuForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#menuForm')[0]; // You need to use standard javascript object here
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                if(d.status === 200){
                    CommonLib.notification.success(d.msg);
                    setTimeout(() => {
                        window.location = d.url;
                    }, 1000);
                }else{
                    CommonLib.notification.error(d.msg);
                }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
    });
</script>
@endsection
@endsection
