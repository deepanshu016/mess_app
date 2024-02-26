<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="Kleon Admin Template">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="shortcut icon" type="image/png">
    <link href="{{ asset('frontend/assets/img/apple-touch-icon.html') }}" rel="apple-touch-icon">
    <link href="{{ asset('frontend/assets/img/apple-touch-icon-72x72.html') }}" rel="apple-touch-icon" sizes="72x72">
    <link href="{{ asset('frontend/assets/img/apple-touch-icon-114x114.html') }}" rel="apple-touch-icon" sizes="114x114">
    <link href="{{ asset('frontend/assets/img/apple-touch-icon-144x144.html') }}" rel="apple-touch-icon" sizes="144x144">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/main.css" id="stylesheet">
    @yield('page_styles')
</head>
<body class="bg-light">
    <!-- Preloader -->
    <div id="preloader" style="display:none;">
        <div class="preloader-inner">
            <div class="spinner"></div>
            <div class="logo"><img src="{{ asset('/') }}frontend/assets/img/logo-icon.svg" alt="img"></div>
        </div>
    </div>
    @if(!empty(Auth::user()))
        @include('pages.layout.header')
        @can('admin')
            @include('pages.admin.sidebar')
        @elsecan('mess_owner')
            @include('pages.mess_owner.sidebar')
        @elsecan('customer')
            @include('pages.customer.sidebar')
        @endif
    @endif
    @yield('content')
    <div class="modal fade" id="changePasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordFrom" method="POST" action="{{ route('change.password') }}">
                        @csrf
                        <input type="hidden" class="form-control user_id" name="user_id" value="{{ @$user->id}}">
                        <div class="form-group">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" name="password" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Confirm Password </label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-light-200 text-danger btn-sm px-2" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary  btn-sm px-2">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Core JS -->
    <script src="{{ asset('/') }}frontend/assets/js/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('/') }}frontend/assets/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery UI Kit -->
    <script src="{{ asset('/') }}frontend/plugins/jquery_ui/jquery-ui.1.12.1.min.js"></script>
    <!-- ApexChart -->
    <!-- Peity  -->
    <script src="{{ asset('/') }}frontend/plugins/peity/jquery.peity.min.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/peity/piety-init.js"></script>
    <!-- Select 2 -->
    <script src="{{ asset('/') }}frontend/plugins/select2/js/select2.min.js"></script>
    <!-- Datatables -->
    <script src="{{ asset('/') }}frontend/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/datatables/js/datatables.init.js"></script>
    <!-- Date Picker -->
    <script src="{{ asset('/') }}frontend/plugins/flatpickr/flatpickr.min.js"></script>
    <!-- Dropzone -->
    <script src="{{ asset('/') }}frontend/plugins/dropzone/dropzone.min.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/dropzone/dropzone_custom.js"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('/') }}frontend/plugins/tinymce/tinymce.min.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/prism/prism.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/jquery-repeater/jquery.repeater.js"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('/') }}frontend/plugins/sweetalert/sweetalert2.min.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/sweetalert/sweetalert2-init.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/toastr/toastr.min.js"></script>
    <script src="{{ asset('/') }}frontend/plugins/toastr/toastr-init.js"></script>
    <!-- Snippets JS -->
    <script src="{{ asset('/') }}frontend/assets/js/snippets.js"></script>
    <!-- Theme Custom JS -->
    <script src="{{ asset('/') }}frontend/assets/js/theme.js"></script>
    <script src="{{ asset('/') }}frontend/common/CommonLib.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    @yield('page_scripts')
    <script>
        $(function() {
            var maxChars = 250;
            $(".short_description").on("input", function() {
                var charCount = $(this).val().length;
                $(this).closest('.form-group').find(".short_description_count").text(charCount + " / " + maxChars + " characters");
                if (charCount > maxChars) {
                    $(this).val($(this).val().substring(0, maxChars - 1));
                    $(this).closest('.form-group').find(".short_description_count").text("250 / " + maxChars + " characters");
                    CommonLib.notification.error('Limit Exceeded');
                }
            });
        });
    </script>
</body>
</html>
