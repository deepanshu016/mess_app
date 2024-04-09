@extends('pages.layout.layout')
@section('title','Mess App | Manage User')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($user)) ? 'Add User' : 'Update User' }}</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">User</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="bannerForm" method="POST" action="{{ (empty($user)) ? route('admin.users.save') : route('admin.users.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ @$user->name }}">
                            <input type="hidden" class="form-control" name="id" placeholder="ID" value="{{ @$user->id }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ @$user->email }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ @$user->phone }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Photo <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="user_image" accept="images/*">
                            @if(!empty($user) && isset($user->getMedia("USER_IMAGE")[0]))
                                <img src="{{ asset('public/media/').'/'.$user->getMedia("USER_IMAGE")[0]->id.'/'.$user->getMedia("USER_IMAGE")[0]->file_name }}" width="100" height="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Roles</label>
                            <select class="form-control" name="status">
                                <option value="">Select Role</option>
                                @if(!empty($roleList))
                                    @foreach($roleList as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Level Type</label>
                            <select class="form-control level_type" name="status">
                                <option value="">Select Level Type</option>
                                <option value="country" {{ (isset($user) && ($user->status  == 'country')) ? 'selected' : ''}}>Country</option>
                                <option value="state" {{ (isset($user) && ($user->status  == 'state')) ? 'selected' : ''}}>State</option>
                                <option value="city" {{ (isset($user) && ($user->status  == 'state')) ? 'selected' : ''}}>City</option>
                            </select>
                        </div>
                        <div class="form-group country-wrapper"></div>
                        <div class="form-group state-wrapper"></div>
                        <div class="form-group city-wrapper"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($banner)) ? 'Update' : 'Save' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@section('page_scripts')
<script>
    $(function(){
        $("body").on('submit','#bannerForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#bannerForm')[0];
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
        $("body").on('change','.level_type', function () {
            var level_type = $(this).val();
            var formData = new FormData();
            formData.append('level_type',level_type);
            const url = "{{ route('get.countries') }}";
            CommonLib.ajaxForm(formData,'POST',url).then(d=>{
                if(d.status === 200){
                    var class_name = (level_type == 'state' || level_type == 'city') ? 'get-states' : '';
                    var html =`<label class="form-label">Country</label><select class="form-control ${class_name}" name="country">`;
                    $.each(d.data,function(item){
                        html += '<option value="'+ this.id +'">'+ this.name+'</option>';
                    })
                    html += '</select>';
                    $(".country-wrapper").html(html);
                }else{
                    CommonLib.notification.error(d.msg);
                }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
        $("body").on('change','.get-states', function () {
            var country_id = $(this).val();
            var level_type = $(".level_type").val();
            if(level_type === ''){
                CommonLib.notification.error('Please choose Level type first');
                return;
            }
            var formData = new FormData();
            formData.append('country_id',country_id);
            formData.append('level_type',level_type);
            const url = "{{ route('get.states') }}";
            CommonLib.ajaxForm(formData,'POST',url).then(d=>{
                if(d.status === 200){
                    if(level_type === 'state'){
                       showMultipleStatesList(d.data);
                    }else{
                       showSingleStateList(d.data);
                    }
                }else{
                    CommonLib.notification.error(d.msg);
                }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
        $("body").on('change','.get-cities', function () {
            var country_id = $('.get-states').val();
            var level_type = $(".level_type").val();
            var state_id = $(this).val();
            if(level_type === '' && country_id == ''){
                CommonLib.notification.error('Please choose Level type first');
                return;
            }
            var formData = new FormData();
            formData.append('country_id',country_id);
            formData.append('state_id',state_id);
            formData.append('level_type',level_type);
            const url = "{{ route('get.cities') }}";
            CommonLib.ajaxForm(formData,'POST',url).then(d=>{
                if(d.status === 200){
                    showMultipleCitiesList(d.data)
                }else{
                    CommonLib.notification.error(d.msg);
                }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
        function showMultipleStatesList(data){
            var html =`<label class="form-label">States</label><select class="form-control kleon-select-simple" name="state_id[]"  multiple="multiple" placeholder="Select Multiple State">`;
            $.each(data,function(item){
                html += '<option value="'+ this.id +'">'+ this.name+'</option>';
            })
            html += '</select>';
            $(".state-wrapper").html(html);
            $(".kleon-select-simple").select2({
                selectOnClose: false,
                minimumResultsForSearch: -1,
                placeholder: "Select multiple States",
                allowClear: true
            });
        }
        function showSingleStateList(data){
            var html =`<label class="form-label">States</label><select class="form-control get-cities" name="state_id" placeholder="Select State">`;
            $.each(data,function(item){
                html += '<option value="'+ this.id +'">'+ this.name+'</option>';
            })
            html += '</select>';
            $(".state-wrapper").html(html);
        }
        function showMultipleCitiesList(data){
            var html =`<label class="form-label">Cities</label><select class="form-control city-multiple" name="city_id[]"  multiple="multiple" placeholder="Select Multiple Cities">`;
            $.each(data,function(item){
                html += '<option value="'+ this.id +'">'+ this.name+'</option>';
            })
            html += '</select>';
            $(".city-wrapper").html(html);
            $(".city-multiple").select2({
                selectOnClose: false,
                minimumResultsForSearch: -1,
                placeholder: "Select multiple Cities",
                allowClear: true
            });
        }
    });
</script>
@endsection
@endsection
