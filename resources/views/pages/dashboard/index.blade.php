@extends('layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid" id="top_breadcrumb">
            <div class="page-title">

            </div>
        </div>
        <div class="container-fluid default-dashboard">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 proorder-xxl-6 col-lg-12 box-col-12">
                    <div class="card growthcard">
                        <div class="card-header card-no-border pb-0">
                            <div class="header-top">
                                <h3>Biểu thống kê</h3>

                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div id="growth-chart">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 proorder-xxl-6 col-sm-12 box-col-12">
                    <div class="card earning-card">
                        <div class="card-header pb-0 card-no-border">
                            <div class="header-top">
                                <h3>Biểu thống kê </h3>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" id="userdropdown3" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">Tháng
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="userdropdown3"><a
                                            class="dropdown-item" href="#">Tuần</a><a class="dropdown-item"
                                                                                      href="#">Tháng</a><a
                                            class="dropdown-item" href="#">Năm</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div id="earnings-chart"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- apex-->
    <script src="template-admin/admin/js/chart/apex-chart/apex-chart.js"></script>
    <script src="template-admin/admin/js/chart/apex-chart/stock-prices.js"></script>
    <script src="template-admin/admin/js/dashboard/dashboard_1.js"></script>
@endsection
