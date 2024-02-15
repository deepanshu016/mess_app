@extends('pages.layout.layout')
@section('title','Mess App | Profile')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Profile</h2>
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
                    <h5 class="mb-0">Profile</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="profileFrom" method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                        @csrf
                        @if($user->hasRole('MESS_OWNER'))
                            <div class="form-group">
                                <label class="form-label">Mess Name</label>
                                <input type="text" class="form-control" name="mess_name" placeholder="Mess Name" value="{{ @$user->mess_owner->mess_name}}">
                                <input type="hidden" class="form-control" name="mess_owner_id" value="{{ @$user->mess_owner->id}}">
                            </div>
                        @endif
                        <input type="hidden" class="form-control" name="user_id" value="{{ @$user->id}}">
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Name"  value="{{ @$user->name}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email </label>
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ @$user->email}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ @$user->phone}}">
                        </div>
                        @if($user->hasRole('MESS_OWNER'))
                            <div class="form-group">
                                <label class="form-label">Logo</label>
                                <input type="file" class="form-control" name="mess_logo" accept="images/*">
                                @if(!empty($user) && isset($user->mess_owner->getMedia("MESS_LOGO_IMAGE")[0]))
                                    <img src="{{ asset('public/media/').'/'.$user->mess_owner->getMedia("MESS_LOGO_IMAGE")[0]->id.'/'.$user->mess_owner->getMedia("MESS_LOGO_IMAGE")[0]->file_name }}" width="100" height="100">
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">About Mess</label>
                                <textarea class="form-control" name="mess_description"  placeholder="About Mess" maxlength="500">{{ @$user->mess_owner->mess_description}}</textarea>
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
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
        $("body").on('submit','#profileFrom',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#profileFrom')[0]; // You need to use standard javascript object here
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                console.log("Dataa",d)
                if(d.status === 200){
                    CommonLib.notification.success(d.msg);
                    setTimeout(() => {
                        window.location = d.url;
                    }, 1000);
                }else{
                    CommonLib.notification.error(d.errors);
                }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
    });
</script>
@endsection
@endsection
