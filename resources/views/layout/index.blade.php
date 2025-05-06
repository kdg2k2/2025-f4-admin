@extends('layout.master')

@section('css')
    <link rel="stylesheet" href="assets/js/datatables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/js/datatables/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/js/datatables/use-datatable.css">

    <link rel="stylesheet" href="assets/js/sumoselect/sumoselect.css">

    @yield('style')
@endsection

@section('main')
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        @include('partials.header')
        <div class="page-body-wrapper">
            @include('partials.sidebar')
            @yield('content')
            @include('partials.footer')
        </div>
    </div>
@endsection

@section('modal')
    @include('partials.modals')
@endsection

@section('js')
    <script src="template-admin/admin/js/sidebar.js"></script>
    <script src="template-admin/admin/js/height-equal.js"></script>
    <script src="template-admin/admin/js/config.js"></script>
    <script src="template-admin/admin/js/scrollbar/simplebar.js"></script>
    <script src="template-admin/admin/js/scrollbar/custom.js"></script>
    <script src="template-admin/admin/js/slick/slick.min.js"></script>
    <script src="template-admin/admin/js/slick/slick.js"></script>
    <script src="template-admin/admin/js/animation/tilt/tilt.jquery.js"></script>
    <script src="template-admin/admin/js/animation/tilt/tilt-custom.js"></script>

    <script src="assets/js/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/datatables/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/js/datatables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/js/datatables/use-datatable.js"></script>

    <script src="assets/js/sumoselect/jquery.sumoselect.js"></script>
    <script src="assets/js/sumoselect/use-sumoselect.js"></script>

    <script src="assets/js/tool-tips.js"></script>
    <script src="assets/js/auto-add-required-mark.js"></script>
    <script src="assets/js/fill-select.js"></script>
    <script src="assets/js/format-number.js"></script>
    <script src="assets/js/format-datetime.js"></script>

    <script>
        refreshSumoSelect();
        showRequiredMark();
    </script>
    @yield('script')
@endsection
