@extends('pages.layout.layout')
@section('title','Mess App | Manage FAQs')
@section('content')
<main class="main-wrapper">
    <div class="container-fluid">
        <div class="inner-contents">
            <div class="page-header d-flex align-items-center justify-content-between mr-bottom-30">
                <div class="left-part">
                    <h2 class="text-dark">{{ (!isset($faq)) ? 'Add FAQs' : 'Update FAQs' }}</h2>
                </div>
            </div>
            <div class="card border-0">
                <div class="card-header bg-transparent border-0 p-5 pb-0">
                    <h5 class="mb-0">FAQs</h5>
                </div>

                <div class="card-body pt-3">
                    <form id="faqForm" method="POST" action="{{ (empty($faq)) ? route('admin.faq.save') : route('admin.faq.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Question <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="question" placeholder="Question" value="{{ @$faq->question}}">
                            <input type="hidden" class="form-control" name="id" placeholder="ID" value="{{ @$faq->id}}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Answer<span class="text-danger">*</span></label>
                            <textarea class="form-control full_description" id="answer" name="answer" rows="4" cols="50" placeholder="Answer">{{ @$faq->answer}}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status">
                                <option value="">Select Status</option>
                                <option value="active" {{ (isset($faq) && ($faq->status  == 'active')) ? 'selected' : ''}}>Active</option>
                                <option value="inactive" {{ (isset($faq) && ($faq->status  == 'inactive')) ? 'selected' : ''}}>Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ (isset($faq)) ? 'Update' : 'Save' }}</button>
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
        $("body").on('submit','#faqForm',function(e){
            e.preventDefault();
            const url = $(this).attr('action');
            const method = $(this).attr('method');
            var formData = $('#faqForm')[0];
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
        const types = ['answer'];
        function createEditor(elementId) {
            ClassicEditor.create(document.querySelector(elementId)).then(editor => {
                    console.log(editor);
            }).catch(error => {
                    console.error(error);
            });
        }
        types.forEach(day => {
            createEditor(`#${day}`);
        });
    });
</script>
@endsection
@endsection
