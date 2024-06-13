@extends('frontend.layout.master')
@section('title','Mess App | Profile Page')
@section('content')
<!-- SubHeader =============================================== -->
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="{{ asset('/') }}site/img/sub_header_cart.jpg" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <div id="sub_content">
            <h1>Profile Page</h1>
            <p>Qui debitis meliore ex, tollit debitis conclusionemque te eos.</p>
            <p></p>
        </div><!-- End sub_content -->
    </div><!-- End subheader -->
</section><!-- End section -->
<!-- End SubHeader ============================================ -->

<div id="position">
    <div class="container">
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li>Profile Page</li>
        </ul>
    </div>
</div><!-- Position -->

<div class="modal fade" id="paymentRequests" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
            <form id="paymentForm" method="POST" action="{{ route('customer.payment.request.save') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" class="form-control" name="user_id" placeholder="Amount" value="{{ auth()->user()->id}}">
                <input type="hidden" class="form-control" name="mess_id" placeholder="Amount" value="{{ auth()->user()->mess_id}}">
                <div class="form-group">
                    <label class="form-label">Amount </label>
                    <input type="text" class="form-control" name="amount" placeholder="Amount">
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Date </label>
                    <input type="date" class="form-control" name="payment_date" placeholder="Payment Date">
                </div>
                <div class="form-group">
                    <label class="form-label">Screenshot </label>
                    <input type="file" class="form-control" name="reference_screenshot">
                </div>
                <div class="form-group">
                    <label class="form-label">Payment Mode </label>
                    <select class="form-control" name="payment_mode">
                        <option value="">Select Payment Mode</option>
                        <option value="cash">Cash</option>
                        <option value="online">Online</option>
                    </select>
                </div>
                {{-- <div class="text-left">
                    <a href="#">Forgot Password?</a>
                </div> --}}
                <button type="submit" class="btn btn-submit">Submit</button>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="paymentDetails" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-popup">
            <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
            <h4>Please use below payment methods to make payment </h4>
            <div class="form-group">
                <p>QR CODE </label><br/>
                @if(!empty( $user->assigned_mes) && $user->assigned_mess->qr_code)
                    <img src="{{ @$user->assigned_mess->qr_code}}" width="250" height="250">
                @else
                    <h6 class="fw-semibold text-warning mb-0"><span class="indicator bg-warning"></span> Please contact to mess to upload QR Code </h6>
                @endif
            </div>
            <div class="form-group">
                <label class="form-label">UPI Details </label>
                <span>{!! @$user->assigned_mess->account_details !!}</span>
            </div>
        </div>
    </div>
</div>

<!-- Content ================================================== -->
<div class="container margin_60">
    <div id="tabs" class="tabs">
        <nav>
            <ul class="main-tab-wrapper">
                <li class="tab-current"><a href="section-2" class="icon-settings change-tabs"><span>Transaction</span></a>
                <li><a href="payment-requests" class="icon-settings change-tabs"><span>Payment Requests</span></a> </li>
                <li><a href="section-3" class="icon-settings change-tabs"><span>Settings</span></a> </li>
                <li><a href="assigned-mess" class="icon-settings change-tabs"><span>Mess Details</span></a> </li>
            </ul>
        </nav>
        <div class="content content_wrapper">
            <section id="section-2" class="content-current">
                <div class="indent_title_in">
                    <i class="icon_house_alt"></i>
                    <h3>Transaction</h3>
                    <p>Here is the list of all your transaction</p>
                </div>

                <div class="wrapper_indent">
                    <table class="table table-striped cart-list" id="transactionList"></table>
                </div>

            </section><!-- End section 1 -->
            <section id="payment-requests">
                <div class="indent_title_in">
                    <i class="icon_house_alt"></i>
                    <h3>Payment Requests</h3>
                    <p>Here is the list of all your transaction</p>
                </div>

                <div class="wrapper_indent">
                    <a class="btn_1" href="#0" data-toggle="modal" data-target="#paymentDetails" style="float: right;margin-bottom: 10px;">View Payment Details</a>
                    <a class="btn_1" href="#0" data-toggle="modal" data-target="#paymentRequests" style="float: right;margin-bottom: 10px;margin-right: 18px !important;">Add New</a>
                    <table class="table table-striped cart-list" id="paymentList"></table>
                </div>

            </section><!-- End section 1 -->
            <section id="section-3">
                <div class="row">
                    <div class="col-md-6 col-sm-6 add_bottom_15">
                        <div class="indent_title_in">
                            <i class="icon_lock_alt"></i>
                            <h3>Change your password</h3>
                            <p>
                                Mussum ipsum cacilds, vidis litro abertis.
                            </p>
                        </div>
                        <div class="wrapper_indent">
                            <form id="changePasswordFrom" method="POST" action="{{ route('change.password') }}">
                                @csrf
                                <input type="hidden" class="form-control" name="user_id" value="{{ auth()->user()->id}}">
                                <div class="form-group">
                                    <label>New password</label>
                                    <input class="form-control" name="password" id="new_password" type="password">
                                </div>
                                <div class="form-group">
                                    <label>Confirm new password</label>
                                    <input class="form-control" name="password_confirmation" id="confirm_new_password" type="password">
                                </div>
                                <button type="submit" class="btn_1 green">Update Password</button>
                            </form>
                        </div><!-- End wrapper_indent -->
                    </div>
                    <div class="col-md-6 col-sm-6 add_bottom_15">
                        <div class="indent_title_in">
                            <i class="icon_mail_alt"></i>
                            <h3>Update your Profile</h3>
                            <p>
                               Update your profile anytime
                            </p>
                        </div>
                        <div class="wrapper_indent">
                            <form id="profileFrom" method="POST" action="{{ route('update.profile') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" class="form-control" name="user_id" value="{{ @$user->id}}">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Name"  value="{{ @$user->name}}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" name="email" id="email" type="text" placeholder="Email" value="{{ @$user->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input class="form-control" name="phone" id="phone" type="text" placeholder="Phone" value="{{ @$user->phone}}">
                                </div>
                                <div class="form-group">
                                    <label>Referral Code</label>
                                    <span>{{ @$user->referral_code}}</span>
                                    <input class="form-control" id="textToCopy" type="hidden" value="{{ @$user->referral_code}}">
                                </div>
                                <button type="submit" class="btn_1 green">Update Email</button>
                            </form>
                        </div><!-- End wrapper_indent -->
                    </div>
                </div>
                <!-- End row -->
            </section>
            <section id="assigned-mess">
                <div class="row">
                    <div class="col-md-6 col-sm-6 add_bottom_15">
                        @if(!empty($user->assigned_mess))
                            <div class="indent_title_in">
                                <h3>Mess Detail</h3>
                                <h4>Mess Name</h4>
                                <img width="100" height="100" style="border-radius: 50%;" src="{{ @$user->assigned_mess->logo}}">
                                <h3>
                                    {{ @$user->assigned_mess->mess_name }}
                                </h3>
                            </div>
                            <div class="wrapper_indent">
                                <div class="form-group">
                                    <label>Location</label>
                                    {{ @$user->assigned_mess->address }},{{ @$user->assigned_mess->city->name }}, {{ @$user->assigned_mess->state->name }}, {{ @$user->assigned_mess->country->name }},{{ @$user->assigned_mess->pincode }}
                                </div>
                            </div>
                        @else
                            <p class="text-danger">Mess not Selected yet</p>
                        @endif
                        <div class="wrapper_indent">
                            <div class="form-group">
                                <label>Your Wallet Amount</label>
                                INR {{ @$user->payment }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 add_bottom_15">
                        @if(!empty($user->assigned_mess))
                        <div class="indent_title_in">
                            <h3>Selected Menus</h3>
                            <p>Breakfast:- {{ ($user && $user->breakfast == 1) ? 'Yes' : 'No'}}</p>
                            <p>Lunch:- {{ ($user && $user->lunch  == 1) ? 'Yes' : 'No'}}</p>
                            <p>Dinner:- {{ ($user && $user->dinner == 1) ? 'Yes' : 'No'}}</p>
                        </div>
                        @else
                            <p class="text-danger">Mess not Selected yet</p>
                        @endif
                    </div>
                </div>
                <!-- End row -->
            </section>
            <!-- End section 3 -->
        </div><!-- End content -->
    </div>
</div><!-- End container  -->
<!-- End Content =============================================== -->
@endsection
@section('page_script')
<script>
    $("body").on('submit','#changePasswordFrom',function(e){
        e.preventDefault();
        const url = $(this).attr('action');
        const method = $(this).attr('method');
        var formData = $('#changePasswordFrom')[0];
        formData = new FormData(formData);
        CommonLib.ajaxForm(formData,method,url).then(d=>{
            if(d.status === 200){
                CommonLib.notification.success(d.msg);
                setTimeout(() => {
                    window.location = "{{ route('view.profile') }}";
                }, 1000);
            }else{
                CommonLib.notification.error(d.errors);
            }
        }).catch(e=>{
            CommonLib.notification.error(e.responseJSON.errors);
        });
    });
    $("body").on("click",'.change-tabs',function(e){
        e.preventDefault();
        var ref = $(this).attr("href");
        $(this).closest(".main-tab-wrapper").find('li').removeClass('tab-current');
        $(this).closest("li").addClass("tab-curren");
        $(".content_wrapper").find('section').removeClass("content-current");
        $("#"+ref).addClass("content-current");
    });

    $(function(){
        $('#transactionList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('transaction.data.datatables') }}" + "?user_id=" + {{ Auth::user()->id }},
                type: 'GET',
            },
            columns: [
                {
                    data: 'customer_name',
                    name: 'Customer Name',
                    render:function(data, type, row, meta){
                        return row.user.email;
                    }
                },
                {
                    data: 'type',
                    name: 'Type',
                    render:function(data, type, row, meta){
                        return (row.status === 'debit') ? '<h6 class="fw-semibold text-warning mb-0"><span class="indicator bg-warning"></span> DEBIT</h6>' : '<h6 class="fw-semibold text-success mb-0"><span class="indicator bg-success"></span> CREDIT</h6>';
                    }
                },
                {
                    data: 'tag',
                    name: 'Tag',
                    render:function(data, type, row, meta){
                        return row.transaction_tag;
                    }
                },
                {
                    data: 'amount',
                    name: 'Amount',
                    render:function(data, type, row, meta){
                        return 'INR '+row.amount;
                    }
                },
                {
                    data: 'balance',
                    name: 'Balance',
                    render:function(data, type, row, meta){
                        return 'INR '+ row.balance;
                    }
                }
            ],
            language: {
                search: '<i class="bi bi-search"></i>',
                searchPlaceholder: "Search here",
                paginate: {
                next: '<i class="bi bi-chevron-right"></i>',
                previous: '<i class="bi bi-chevron-left"></i>'
                }
            },
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            rowId:'id'
        });
        $("body").on("click",'.delete',function(e){
            e.preventDefault();
            var formData = new FormData();
            var id = $(this).data("id");
            var url = $(this).data("url");
            formData.append('id',id);
            CommonLib.sweetalert.confirm(formData,'DELETE',url);
        });
        $('#paymentList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('common.payment.request.datatables') }}" + "?user_id=" + {{ Auth::user()->id }},
                type: 'GET',
            },
            columns: [
                {
                    data: 'name',
                    name: 'Name',
                    render:function(data, type, row, meta){
                        return row.user.name;
                    }
                },
                {
                    data: 'amount',
                    name: 'Amount',
                    render:function(data, type, row, meta){
                        return (row.amount) ? `INR ${parseFloat(row.amount)}` : `INR 0.00`;
                    }
                },
                {
                    data: 'screenshot',
                    name: 'Screenshot',
                    render:function(data, type, row, meta){
                        var media = '';
                        if(row.media.length > 0){
                            media += `<i class="bi bi-paperclip"></i> <a href="${row.medias}" class="text-primary mb-3" download="${row.medias}">${row.media[0].uuid}</a>`;
                        }else{
                            media += '-';
                        }
                        return media;
                    }
                },
                {
                    data: 'status',
                    name: 'Status',
                    render:function(data, type, row, meta){
                        if(row.status === 'pending'){
                            return '<h6 class="fw-semibold text-warning mb-0"><span class="indicator bg-warning"></span> Pending</h6>';
                        }
                        if(row.status === 'accept'){
                            return '<h6 class="fw-semibold text-success mb-0"><span class="indicator bg-success"></span> Accepted</h6>';
                        }
                        if(row.status === 'rejected'){
                            return '<h6 class="fw-semibold text-danger mb-0"><span class="indicator bg-danger"></span> Rejected</h6>';
                        }
                    }
                },
                {
                    data: 'date',
                    name: 'Date',
                    render:function(data, type, row, meta){
                        return new Date(row.payment_date).toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' });
                    }
                }
            ],
            language: {
                search: '<i class="bi bi-search"></i>',
                searchPlaceholder: "Search here",
                paginate: {
                next: '<i class="bi bi-chevron-right"></i>',
                previous: '<i class="bi bi-chevron-left"></i>'
                }
            },
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            rowId:'id'
        });
        $("body").on('submit','#profileFrom',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#profileFrom')[0];
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                if(d.status === 200){
                    CommonLib.notification.success(d.msg);
                    setTimeout(() => {
                        window.location = "{{ route('view.profile')}}";
                    }, 1000);
                }else{
                    CommonLib.notification.error(d.errors);
                }
            }).catch(e=>{
                CommonLib.notification.error(e.responseJSON.errors);
            });
        });
        $("body").on('submit','#paymentForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#paymentForm')[0];
            formData = new FormData(formData);
            CommonLib.ajaxForm(formData,method,url).then(d=>{
                if(d.status === 200){
                    CommonLib.notification.success(d.msg);
                    setTimeout(() => {
                        window.location = "{{ route('view.profile')}}";
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
