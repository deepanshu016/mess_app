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
    @yield('page_scripts')
</body>
</html>
