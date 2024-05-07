@extends('pages.layout.layout')
@section('title','Mess App | Manage Cuisine')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($singleCuisine)) ? 'Add Cuisine' : 'Update Cuisine' }}</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Cuisine</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="cuisineForm" method="POST" action="{{ (empty($singleCuisine)) ? route('admin.cuisines.save') : route('admin.cuisines.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Cuisine Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Cuisine Name" value="{{ @$singleCuisine->name}}">
                            <input type="hidden" class="form-control" name="id" placeholder="ID" value="{{ @$singleCuisine->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="1" {{ (isset($singleCuisine) && ($singleCuisine->status  == '1')) ? 'selected' : ''}}>Active</option>
                                <option value="0" {{ (isset($singleCuisine) && ($singleCuisine->status  == '0')) ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($singleCuisine)) ? 'Update' : 'Save' }}</button>
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
        $("body").on('submit','#cuisineForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#cuisineForm')[0];
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
