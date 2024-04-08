@extends('pages.layout.layout')
@section('title','Mess App | Permissions')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Permissions</h2>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            Permissions for {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                </div>
            </div>
            <form id="permissionForm" method="POST" action="{{ route('admin.role.permission.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="col">
                        <div class="row">
                            <strong>Permissions:</strong>
                            <input type="hidden" class="form-control" name="id" value="{{ @$role->id}}">
                            @foreach($permission as $value)
                                <div class="col-3">
                                    <label>
                                        <input type="checkbox" name='permission[]' value="{{$value->id}}"  {{ in_array($value->id, $rolePermissions) ? 'checked' : ''}}>
                                        {{ $value->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>
@section('page_scripts')
<script>
    $(function(){
        $("body").on('submit','#permissionForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#permissionForm')[0]; // You need to use standard javascript object here
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
