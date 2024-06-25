@extends('pages.layout.layout')
@section('title','Mess App | Manage Customer')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($customer)) ? 'Add Customer' : 'Update Customer' }}</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Customer</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="customerForm" method="POST" action="{{ (empty($customer)) ? route('mess_owner.customer.save') : route('mess_owner.customer.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ @$customer->name}}">
                            <input type="hidden" class="form-control" name="user_id" value="{{ @$customer->id}}">
                            <input type="hidden" class="form-control" name="customer_menu_id" value="{{ @$customer->customer_menu->id}}">
                            <input type="hidden" class="form-control" name="payment_id" value="{{ @$customer->payment->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{ @$customer->email}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ @$customer->phone}}">
                        </div>
                        @if(empty($customer))
                        <div class="form-group">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">Photo</label>
                            <input type="file" class="form-control" name="mess_logo" accept="images/*">
                            @if(!empty($customer) && isset($customer->getMedia("CUSTOMER_PHOTO")[0]))
                                <img src="{{ asset('public/media/').'/'.$customer->getMedia("CUSTOMER_PHOTO")[0]->id.'/'.$customer->getMedia("CUSTOMER_PHOTO")[0]->file_name }}" width="100" height="100">
                            @endif
                        </div>
                        <p>Meal type <span class="text-danger">*</span></p>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input bg-primary border-0" id="radio10" name="food_type" value="veg" {{ (isset($customer) && $customer->meal_type == 'veg') ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio10">Veg</label><br>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input bg-secondary border-0" id="radio11" name="food_type" value="non_veg" {{ (isset($customer) && $customer->meal_type == 'non_veg') ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio11">Non Veg</label><br>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subscription start from  <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="subscription_starts_at" placeholder="Subscription start from" value="{{ @$customer->subscription_starts_at }}" disabled>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="active" {{ (isset($customer) && ($customer->status  == 'active')) ? 'selected' : ''}}>Active</option>
                                <option value="inactive" {{ (isset($customer) && ($customer->status  == 'inactive')) ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($customer)) ? 'Update' : 'Save' }}</button>
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
        $("body").on('submit','#customerForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#customerForm')[0]; // You need to use standard javascript object here
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
        $("body").on("click",'.payment_status',function(e){
            var currentWrapper = $(this);
            const food_type = currentWrapper.val();
            switch (food_type) {
                case 'paid':
                    $(".payment_screenshot").removeClass('d-none');
                    break;
                case 'unpaid':
                    $(".payment_screenshot").addClass('d-none');
                    break;
                default:
                    break;
            }
        });
    });
</script>
@endsection
@endsection
