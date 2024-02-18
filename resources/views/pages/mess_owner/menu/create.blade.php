@extends('pages.layout.layout')
@section('title','Mess App | Our Menu')
@section('content')
@section('page_styles')
<link href="https://www.tiny.cloud/css/codepen.min.css" />
@endsection
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Our Menu</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Menu</h5>
                </div>

                <div class="card-body">
                    <div class="table table-flex text-dark">
                        <div class="thead fw-bold border-bottom border-1 border-light-200">
                            <div class="row px-2">
                                <div class="col col-2 text-center">Day <span class="float-end"></span></div>
                                <div class="col col-3 text-center">Breakfast <span class="float-end"></span></div>
                                <div class="col col-3 text-center">Lunch <span class="float-end"></span></div>
                                <div class="col col-3 text-center">Dinner <span class="float-end"></span></div>
                                <div class="col col-1 text-center text-end">Action</div>
                            </div>
                        </div>

                        <div class="tbody">
                            <form class="all-form" method="POST" action="{{ (empty($menu['monday'])) ? route('mess_owner.menu.save') : route('mess_owner.menu.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row px-2 border-bottom border-1 border-light-200">
                                    <div class="col col-2 text-center"><input type="hidden" class="form-control" name="id" value="{{ @$menu['sunday']->id}}"><input type="hidden" class="form-control" name="day" value="Mon">Monday</div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="breakfast"><textarea id="breakfast_mon" name="mess_detail_breakfast">{!! @$menu['sunday']->mess_detail_breakfast !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="lunch"><textarea id="lunch_mon" name="mess_detail_lunch">{!! @$menu['sunday']->mess_detail_lunch !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="dinner"><textarea id="dinner_mon" name="mess_detail_dinner">{!! @$menu['sunday']->mess_detail_dinner !!}</textarea></div>
                                    <div class="col col-1 text-center">
                                        <button type="submit" class="add-edit-menu btn btn-primary btn-sm rounded-pill">Update</button>
                                    </div>
                                </div>
                            </form>
                            <form class="all-form" method="POST" action="{{ (empty($menu['tuesday'])) ? route('mess_owner.menu.save') : route('mess_owner.menu.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row px-2 border-bottom border-1 border-light-200">
                                    <div class="col col-2 text-center"><input type="hidden" class="form-control" name="id" value="{{ @$menu['monday']->id}}"><input type="hidden" class="form-control" name="day" value="Tue">Tuesday</div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="breakfast"><textarea id="breakfast_tue" name="mess_detail_breakfast">{{ @$menu['monday']->mess_detail_breakfast}}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="lunch"><textarea id="lunch_tue" name="mess_detail_lunch">{!! @$menu['monday']->mess_detail_lunch !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="dinner"><textarea id="dinner_tue" name="mess_detail_dinner">{!! @$menu['monday']->mess_detail_dinner !!}</textarea></div>
                                    <div class="col col-1 text-center">
                                        <button type="submit" class="add-edit-menu btn btn-primary btn-sm rounded-pill">Update</button>
                                    </div>
                                </div>
                            </form>
                            <form class="all-form" method="POST" action="{{ (empty($menu['wednesday'])) ? route('mess_owner.menu.save') : route('mess_owner.menu.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row px-2 border-bottom border-1 border-light-200">
                                    <div class="col col-2 text-center"><input type="hidden" class="form-control" name="id" value="{{ @$menu['wednesday']->id}}"><input type="hidden" class="form-control" name="day" value="Wed">Wednesday</div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="breakfast"><textarea id="breakfast_wed" name="mess_detail_breakfast">{!! @$menu['wednesday']->mess_detail_breakfast !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="lunch"><textarea id="lunch_wed" name="mess_detail_lunch">{!! @$menu['wednesday']->mess_detail_lunch !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="dinner"><textarea id="dinner_wed" name="mess_detail_dinner">{!! @$menu['wednesday']->mess_detail_dinner !!}</textarea></div>
                                    <div class="col col-1 text-center">
                                        <button type="submit" class="add-edit-menu btn btn-primary btn-sm rounded-pill">Update</button>
                                    </div>
                                </div>
                            </form>
                            <form class="all-form" method="POST" action="{{ (empty($menu['thursday'])) ? route('mess_owner.menu.save') : route('mess_owner.menu.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row px-2 border-bottom border-1 border-light-200">
                                    <div class="col col-2 text-center"><input type="hidden" class="form-control" name="id" value="{{ @$menu['thursday']->id}}"><input type="hidden" class="form-control" name="day" value="Thu">Thursday</div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="breakfast"><textarea id="breakfast_thu" name="mess_detail_breakfast">{!! @$menu['thursday']->mess_detail_breakfast !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="lunch"><textarea id="lunch_thu" name="mess_detail_lunch">{!! @$menu['thursday']->mess_detail_lunch !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="dinner"><textarea id="dinner_thu" name="mess_detail_dinner">{!! @$menu['thursday']->mess_detail_dinner !!}</textarea></div>
                                    <div class="col col-1 text-center">
                                        <button type="submit" class="add-edit-menu btn btn-primary btn-sm rounded-pill">Update</button>
                                    </div>
                                </div>
                            </form>
                            <form class="all-form" method="POST" action="{{ (empty($menu['friday'])) ? route('mess_owner.menu.save') : route('mess_owner.menu.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row px-2 border-bottom border-1 border-light-200">
                                    <div class="col col-2 text-center"><input type="hidden" class="form-control" name="id" value="{{ @$menu['friday']->id}}"><input type="hidden" class="form-control" name="day" value="Fri">Friday</div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="breakfast"><textarea id="breakfast_fri" name="mess_detail_breakfast">{!! @$menu['friday']->mess_detail_breakfast !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="lunch"><textarea id="lunch_fri" name="mess_detail_lunch">{!! @$menu['friday']->mess_detail_lunch !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="dinner"><textarea id="dinner_fri" name="mess_detail_dinner">{!! @$menu['friday']->mess_detail_dinner !!}</textarea></div>
                                    <div class="col col-1 text-center">
                                        <button type="submit" class="add-edit-menu btn btn-primary btn-sm rounded-pill">Update</button>
                                    </div>
                                </div>
                            </form>
                            <form class="all-form" method="POST" action="{{ (empty($menu['saturday'])) ? route('mess_owner.menu.save') : route('mess_owner.menu.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row px-2 border-bottom border-1 border-light-200">
                                    <div class="col col-2 text-center"><input type="hidden" class="form-control" name="id" value="{{ @$menu['saturday']->id}}"><input type="hidden" class="form-control" name="day" value="Sat">Saturday</div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="breakfast"><textarea id="breakfast_sat" name="mess_detail_breakfast">{!! @$menu['saturday']->mess_detail_breakfast !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="dinner"><textarea id="lunch_sat" name="mess_detail_lunch">{!! @$menu['saturday']->mess_detail_lunch !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="breakfast"><textarea id="dinner_sat" name="mess_detail_dinner">{!! @$menu['saturday']->mess_detail_dinner !!}</textarea></div>
                                    <div class="col col-1 text-center">
                                        <button type="submit" class="add-edit-menu btn btn-primary btn-sm rounded-pill">Update</button>
                                    </div>
                                </div>
                            </form>
                            <form class="all-form" method="POST" action="{{ (empty($menu['sunday'])) ? route('mess_owner.menu.save') : route('mess_owner.menu.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row px-2 border-bottom border-1 border-light-200">
                                    <div class="col col-2 text-center"><input type="hidden" class="form-control" name="id" value="{{ @$menu['sunday']->id}}"><input type="hidden" class="form-control" name="day" value="Sun">Sunday</div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="breakfast"><textarea id="breakfast_sun" name="mess_detail_breakfast">{!! @$menu['sunday']->mess_detail_breakfast !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="lunch"><textarea id="lunch_sun" name="mess_detail_lunch">{!! @$menu['sunday']->mess_detail_lunch !!}</textarea></div>
                                    <div class="col col-3 text-center"><input type="hidden" class="form-control" name="menu_type" value="dinnner"><textarea id="dinner_sun" name="mess_detail_dinner">{!! @$menu['sunday']->mess_detail_dinner !!}</textarea></div>
                                    <div class="col col-1 text-center">
                                        <button type="submit" class="add-edit-menu btn btn-primary btn-sm rounded-pill">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@section('page_scripts')
<script src="https://cdn.tiny.cloud/1/qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc/tinymce/6/tinymce.min.js"></script>
<script>
    $(function(){
        $("body").on('submit','.all-form',function(e){
            e.preventDefault();
            var serializedData = $(this).serialize();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = new FormData();
            $.each(serializedData.split('&'), function(index, field) {
                var keyValue = field.split('=');
                var key = decodeURIComponent(keyValue[0]);
                var value = decodeURIComponent(keyValue[1]);
                formData.append(key, value);
            });
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                if(d.status === 200){
                    CommonLib.notification.success(d.msg);
                    setTimeout(() => {
                        window.location = d.url;
                    }, 1000);
                }else{
                    CommonLib.notification.error(d.message);
                }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
    });
    const daysOfWeek = ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'];
    function createEditor(elementId) {
    ClassicEditor.create(document.querySelector(elementId))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
    }
    daysOfWeek.forEach(day => {
        createEditor(`#breakfast_${day}`);
        createEditor(`#lunch_${day}`);
        createEditor(`#dinner_${day}`);
    });
</script>
@endsection
@endsection
