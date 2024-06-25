@extends('pages.layout.layout')
@section('title','Mess App | List')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Menus</h2>
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
                    <h4 class="mb-0">Menus</h4>
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
                        <table id="menuList" class="display">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Menu Type</th>
                                    <th>Menu Details</th>
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
        $('#menuList').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('mess_owner.menu.datatables') }}",
                type: 'GET',
            },
            columns: [
                { data: 'day', name: 'Day' },
                {
                    data: 'menu_type',
                    name: 'Menu Type'
                },
                {
                    data: 'menu_detail',
                    name: 'Menu Details'
                },
                {
                    data: 'id',
                    name: 'Action',
                    render:function(data, type, row, meta){
                        return `<a href="${row.id}/edit" class="btn-video square btn btn-outline-primary rounded-2 px-0 py-0 me-3"><i class="bi bi-pencil"></i></a>
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
    });
</script>
@endsection
