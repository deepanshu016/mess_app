@extends('pages.layout.layout')
@section('title','Mess App | Manage Mess Owner')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($messOwner)) ? 'Add Mess Owner' : 'Update Mess Owner' }}</h2>
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
                    <h5 class="mb-0">Mess Owner</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="messOwnerForm" method="POST" action="{{ (empty($messOwner)) ? route('admin.mess_owner.save') : route('admin.mess_owner.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Mess Name</label>
                            <input type="text" class="form-control" name="mess_name" placeholder="Mess Name" value="{{ @$messOwner->mess_name}}">
                            <input type="hidden" class="form-control" name="mess_owner_id" value="{{ @$messOwner->id}}">
                            <input type="hidden" class="form-control" name="user_id" value="{{ @$messOwner->user->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Mess Owner Name</label>
                            <input type="text" class="form-control" name="mess_owner_name" placeholder="Mess Owner Name"  value="{{ @$messOwner->user->name}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email </label>
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ @$messOwner->user->email}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ @$messOwner->user->phone}}">
                        </div>
                        @if(empty($messOwner))
                        <div class="form-group">
                            <label class="form-label">Password </label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">Logo</label>
                            <input type="file" class="form-control" name="mess_logo" accept="images/*">
                            @if(empty($messOwner))
                            <img src="{{ }}" width="100" height="100">
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">About Mess</label>
                            <textarea class="form-control" name="mess_description"  placeholder="About Mess" maxlength="500">{{ @$messOwner->mess_description}}</textarea>
                        </div>
                        <p>Food type</p>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input bg-primary border-0 choose_food_type" id="radio10" name="food_type" value="veg" {{ (isset($messOwner) && $messOwner->food_type == 'veg') ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio10">Veg</label><br>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input bg-secondary border-0 choose_food_type" id="radio11" name="food_type" value="non_veg" {{ (isset($messOwner) && $messOwner->food_type == 'non_veg') ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio11">Non Veg</label><br>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input bg-warning border-0 choose_food_type" id="radio11" name="food_type" value="both" {{ (isset($messOwner) && $messOwner->food_type == 'both') ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio11">Both</label><br>
                        </div>
                        @if(!empty($messOwner) && ($messOwner->food_type == 'veg' || $messOwner->food_type == 'both'))
                            <div class="form-group veg_price">
                                <label class="form-label">Veg Price</label>
                                <input type="text" class="form-control" name="veg_price" placeholder="Veg Price" value="{{ @$messOwner->veg_price}}">
                            </div>
                        @else
                            <div class="form-group veg_price d-none">
                                <label class="form-label">Veg Price</label>
                                <input type="text" class="form-control" name="veg_price" placeholder="Veg Price">
                            </div>
                        @endif
                        @if(!empty($messOwner) && ($messOwner->food_type == 'non_veg' || $messOwner->food_type == 'both'))
                            <div class="form-group non_veg_price">
                                <label class="form-label">Non Veg Basic Price</label>
                                <input type="text" class="form-control" name="non_veg_price" placeholder="Non Veg Basic Price" value="{{ @$messOwner->non_veg_price}}">
                            </div>
                        @else
                            <div class="form-group non_veg_price d-none">
                                <label class="form-label">Non Veg Basic Price</label>
                                <input type="text" class="form-control" name="non_veg_price" placeholder="Non Veg Basic Price">
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($messOwner)) ? 'Update' : 'Save' }}</button>
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
        $("body").on('submit','#messOwnerForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#messOwnerForm')[0]; // You need to use standard javascript object here
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                if(d.status === 200){
                    CommonLib.notification.success(d.msg);
                    window.location = d.url;
                }
            }).catch(e=>{
                CommonLib.notification.error(e.errors);
            });
        });
        $("body").on("click",'.choose_food_type',function(e){
            var currentWrapper = $(this);
            const food_type = currentWrapper.val();
            $(".veg_price, .non_veg_price").addClass('d-none');
            switch (food_type) {
                case 'veg':
                    $(".veg_price").removeClass('d-none');
                    break;
                case 'non_veg':
                    $(".non_veg_price").removeClass('d-none');
                    break;
                case 'both':
                    $(".veg_price, .non_veg_price").removeClass('d-none');
                    break;
                default:
                    break;
            }
        });
    });
</script>
@endsection
@endsection