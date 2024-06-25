@extends('pages.layout.layout')
@section('title','Mess App | Manage Customer Subscriptions')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Manage Customer Subscriptions</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Manage Customer Subscriptions</h5>
                </div>

                <div class="card-body pt-3">
                    @can('mess_owner')
                    <form id="subscriptionForm" method="POST" action="{{ route('mess_owner.customer.save.subscription')  }}" enctype="multipart/form-data">
                    @else
                    <form id="subscriptionForm" method="POST" action="{{ route('admin.customer.save.subscription')  }}" enctype="multipart/form-data">

                    @endcan
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Name</label>
                            <p>{{ @$customer->name}}</p>
                            <input type="hidden" class="form-control" name="customer_id" value="{{ @$customer->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <p>{{ @$customer->email}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone </label>
                            <p>{{ @$customer->phone}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Wallet Balance</label>
                            <p>INR {{ ($customer->payment) ? @number_format(count_total_attend_days($customer->id,$customer->mess_id)) : 0.0}}</p>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Refill Amount <span class="text-danger">*</span></label><small>(Amount will be added in current wallet amount)</small>
                            <input type="text" class="form-control" name="refill_amount" placeholder="Refill Amount">
                        </div>
                        {{-- <p>Meal type <span class="text-danger">*</span></p>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input bg-primary border-0" id="radio10" name="food_type" value="veg" {{ (isset($customer) && !empty($customer->customer_menu) && $customer->customer_menu->meal_type == 'veg') ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio10">Veg</label><br>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input bg-secondary border-0" id="radio11" name="food_type" value="non_veg" {{ (isset($customer) && !empty($customer->customer_menu) && $customer->customer_menu->meal_type == 'non_veg') ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio11">Non Veg</label><br>
                        </div> --}}
                        {{-- <p>Meal type <span class="text-danger">*</span></p>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input bg-primary border-0" id="radio10" name="food_type" value="veg" {{ (isset($customer) && !empty($customer->customer_menu) && $customer->customer_menu->meal_type == 'veg') ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio10">Veg</label><br>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input bg-secondary border-0" id="radio11" name="food_type" value="non_veg" {{ (isset($customer) && !empty($customer->customer_menu) && $customer->customer_menu->meal_type == 'non_veg') ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio11">Non Veg</label><br>
                        </div>
                        <p>Meal to be Deliver<span class="text-danger">*</span></p>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input bg-primary border-0" name="meal_time[]" value="breakfast" {{ (isset($customer) && !empty($customer->customer_menu) && $customer->customer_menu->breakfast == 1) ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio10">Breakfast</label><br>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input bg-secondary border-0" name="meal_time[]" value="lunch" {{ (isset($customer) && !empty($customer->customer_menu) && $customer->customer_menu->lunch == 1) ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio11">Lunch</label><br>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" class="form-check-input bg-warning border-0" name="meal_time[]" value="dinner" {{ (isset($customer) && !empty($customer->customer_menu) && $customer->customer_menu->dinner == 1) ? 'checked' : '' }}>
                            <label class="form-label mb-0" for="radio11">Dinner</label><br>
                        </div> --}}
                        {{-- <div class="form-group payment_screenshon">
                            <label class="form-label">Subscription Starts from <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="subscription_start">
                        </div> --}}
                        {{-- <p>Payment <span class="text-danger">*</span></p>
                        <div class="form-group payment_screenshot {{ empty($customer) ? 'd-none' : '' }}">
                            <label class="form-label">Payment Mode <span class="text-danger">*</span></label>
                            <select class="form-control" name="payment_mode">
                                <option value="">Payment Mode</option>
                                <option value="cash">Cash</option>
                                <option value="online">Online</option>
                            </select>
                        </div> --}}
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
        $("body").on('submit','#subscriptionForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#subscriptionForm')[0]; // You need to use standard javascript object here
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
