@extends('pages.layout.layout')
@section('title','Mess App | List')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Mess Owners</h2>
                </div>
                <div class="right-part">
                    <form class="search-form w-auto" action="https://wpthemebooster.com/demo/themeforest/html/kleon/search.php">
                        <input type="text" name="search" class=" bg-white form-control" placeholder="Search">
                        <button type="submit" class="btn"><img src="{{ asset('/') }}frontend/assets/img/svg/search.svg" alt=""></button>
                    </form>
                </div>
            </div>
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Mess Owners Info</h4>
                    <div class="ms-auto d-flex align-items-center gap-3">
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="fs-24 text-gray">
                                <i class="bi bi-three-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu p-0">
                                <a class="dropdown-item" href="#">View</a>
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item text-danger" href="#">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="messOwnerLists" class="display">
                            <thead>
                                <tr>
                                    <th>Mess Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                    <th>Is Home Delivery Available</th>
                                    <th>Food Type</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('page_scripts')
<script>
    $(function(){
        $('#messOwnerLists').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.mess_owner.datatables') }}",
                type: 'GET',
            },
            columns: [
                { data: 'mess_name', name: 'name' },
                {
                    data: 'email',
                    name: 'email',
                    render:function(data, type, row, meta){
                        return row.user.email;
                    }
                },
                {
                    data: 'phone',
                    name: 'phone',
                    render:function(data, type, row, meta){
                        return row.user.phone;
                    }
                },
                {
                    data: 'status',
                    name: 'Status',
                    render:function(data, type, row, meta){
                        var status = '';
                        if(row.user.status == 'active'){
                            status = '<h6 class="fw-semibold text-success mb-0"><span class="indicator bg-success"></span> ACTIVE</h6>';
                        }else{
                            status = '<h6 class="fw-semibold text-danger mb-0"><span class="indicator bg-danger"></span> INACTIVE</h6>'
                        }
                        return status;
                    }
                },
                {
                    data: 'home_delivery',
                    name: 'Is Home Delivery Available',
                    render:function(data, type, row, meta){
                        var status = '';
                        if(row.is_delivery_boy_available == '1'){
                            status = '<h6 class="fw-semibold text-success mb-0"><span class="indicator bg-success"></span> Yes</h6>';
                        }else{
                            status = '<h6 class="fw-semibold text-danger mb-0"><span class="indicator bg-danger"></span> No</h6>'
                        }
                        return status;
                    }
                },
                {
                    data: 'food_type',
                    name: 'food_type',
                    render:function(data, type, row, meta){
                        var foodType = '';
                        if(row.food_type == 'veg'){
                            foodType = 'Veg';
                        }else if(row.food_type == 'non_veg'){
                            foodType = 'Non Veg'
                        }else{
                            foodType = 'Both'
                        }
                        return foodType;
                    }
                },
                {
                    data: 'id',
                    name: 'Action',
                    render:function(data, type, row, meta){
                        return `<a href="${row.user.id}/guest-login" class="btn-video square btn btn-outline-success rounded-2 px-0 py-0 me-3"><i class="bi bi-box-arrow-right"></i></a>
                                <a href="${row.id}/edit" class="btn-video square btn btn-outline-primary rounded-2 px-0 py-0 me-3"><i class="bi bi-pencil"></i></a>
                                <a href="javascript:void(0);" class="btn-video square btn btn-outline-warning rounded-2 px-0 py-0 me-3 change-password" data-id="${row.user.id}" data-bs-toggle="modal" data-bs-target="#changePasswordModal"><i class="bi bi-file-lock"></i></a>
                                <a href="javascript:void(0);" class="btn-video square btn btn-outline-danger rounded-2 px-0 py-0 me-3 delete" data-url="${row.id}/delete" data-id=""><i class="bi bi-trash"></i></a>`;
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
        $("body").on("click",'.change-password',function(e){
            e.preventDefault();
            var user_id = $(this).data('id');
            $("#changePasswordModal").find('.user_id').val(user_id);
        });
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
                        location.reload();
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
