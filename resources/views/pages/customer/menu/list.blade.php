@extends('pages.layout.layout')
@section('title','Mess App | List')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">Marked Days </h2>
                </div>

            </div>
            <div class="card border-0 p-5">
                <div class="card-header pb-5 bg-transparent border-0 d-flex align-items-center justify-content-between gap-3">
                    <h4 class="mb-0">Marked Days</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="markedDaysLists" class="display">
                            <thead>
                                <tr>
                                    <th>Date</th>
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
        $('#markedDaysLists').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('customer.menu.mark_day.datatables') }}",
                type: 'GET',
            },
            columns: [
                {
                    data: 'date',
                    name: 'Date',
                    render:function(data, type, row, meta){
                        return new Date(row.mark_date).toLocaleString('en-US', { year: 'numeric', month: '2-digit', day: '2-digit' });
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
    });
</script>
@endsection
