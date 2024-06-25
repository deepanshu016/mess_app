@extends('pages.layout.layout')
@section('title','Mess App | Manage Gallery')
@section('content')
@section('page_styles')
<style>
    .image-container {
        display: flex;
        overflow-x: auto;
    }
    .image-wrapper {
        position: relative;
        width: 150px;
        height: 150px;
        margin-right: 10px;
        overflow: hidden;
    }
    .image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .trash-icon {
        position: absolute;
        top: -5px;
        left: -5px;
        padding: 5px;
        border-radius: 5px;
        cursor: pointer;
    }
    .trash-icon i {
        color: red;
    }

</style>
@endsection
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($gallery)) ? 'Add Gallery' : 'Update Gallery' }}</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">Gallery</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="galleryForm" method="POST" action="{{ (empty($gallery)) ? route('mess_owner.gallery.save') : route('mess_owner.gallery.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ @$gallery->title}}">
                            <input type="hidden" class="form-control" name="id" placeholder="ID" value="{{ @$gallery->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Media <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="medias[]" accept="images/*,video/*" multiple>
                            @if(!empty($gallery) && !empty($gallery->medias))
                                <div class="image-container">
                                    @foreach($gallery->medias as $media)
                                        <div class="image-wrapper">
                                            <div class="trash-icon">
                                                <a href="javascript:void(0);" class="delete-media" data-url="{{ route('delete.media') }}" data-id="{{ $media['id'] }}"><i class="bi bi-x-circle"></i></a>
                                            </div>
                                            <img src="{{ $media['media_url'] }}" alt="{{ $media['id'] }}" height="100" width="100">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="active" {{ (isset($gallery) && ($gallery->status  == 'active')) ? 'selected' : ''}}>Active</option>
                                <option value="inactive" {{ (isset($gallery) && ($gallery->status  == 'inactive')) ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($gallery)) ? 'Update' : 'Save' }}</button>
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
        $("body").on('submit','#galleryForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#galleryForm')[0];
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
