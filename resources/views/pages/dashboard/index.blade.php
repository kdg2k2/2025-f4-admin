@extends('layout.index')
@section('content')
    <div class="page-body">
        <div class="container-fluid" id="top_breadcrumb">
            <div class="page-title">

            </div>
        </div>
        <div class="container-fluid default-dashboard">
            <div class="card growthcard">
                <div class="card-header card-no-border pb-0">
                    <div class="header-top">
                        <h3>Thống kê doanh thu</h3>
                        <div class="row">
                            <div class="form-group col-lg-6 col-12">
                                <label for="">Từ ngày</label>
                                <input type="date" id="revenue-from" class="form-control">
                            </div>
                            <div class="form-group col-lg-6 col-12">
                                <label for="">Tới ngày</label>
                                <input type="date" id="revenue-to" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-0">
                </div>
            </div>
            <div class="row" id="revenue-charts-container"></div>

            {{-- <div class="row">
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
                                            href="#">Tháng</a><a class="dropdown-item" href="#">Năm</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-0">
                            <div id="earnings-chart"></div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
@section('script')
    <!-- apex-->
    <script src="template-admin/admin/js/chart/apex-chart/apex-chart.js"></script>

    <script>
        // visitor chart
        // var optionsvisitor = {
        //     series: [{
        //             name: "Active",
        //             data: [5000, 6000, 7800, 4000, 5000],
        //         },
        //         {
        //             name: "Bounce",
        //             data: [8000, 9600, 5600, 9000, 8000],
        //         },
        //     ],
        //     chart: {
        //         type: "bar",
        //         height: 225,
        //         offsetX: -20,
        //         offsetY: 10,
        //         toolbar: {
        //             show: false,
        //         },
        //     },
        //     legend: {
        //         show: false,
        //     },
        //     plotOptions: {
        //         bar: {
        //             horizontal: false,
        //             columnWidth: "75%",
        //             borderRadius: 2,
        //         },
        //     },
        //     dataLabels: {
        //         enabled: false,
        //     },
        //     stroke: {
        //         show: true,
        //         width: 6,
        //         colors: ["transparent"],
        //     },
        //     grid: {
        //         show: true,
        //         borderColor: "#e5e5e5",
        //         xaxis: {
        //             lines: {
        //                 show: false,
        //             },
        //         },
        //         yaxis: {
        //             lines: {
        //                 show: true,
        //             },
        //         },
        //     },
        //     colors: [AdmiroAdminConfig.secondary, AdmiroAdminConfig.primary],
        //     xaxis: {
        //         categories: ["Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
        //         tickAmount: 4,
        //         tickPlacement: "between",
        //         labels: {
        //             style: {
        //                 fontSize: "13px",
        //                 fontFamily: "Nunito Sans', sans-serif",
        //                 colors: "#AAA3A0",
        //                 fontWeight: 600,
        //             },
        //         },
        //         axisBorder: {
        //             show: false,
        //         },
        //         axisTicks: {
        //             show: false,
        //         },
        //     },
        //     yaxis: {
        //         categories: ["2000", "4000", "6000", "8000", "10 000"],
        //         labels: {
        //             formatter: function(val) {
        //                 return val;
        //             },
        //             style: {
        //                 fontSize: "13px",
        //                 fontFamily: "Nunito Sans, sans-serif",
        //                 colors: "#AAA3A0",
        //                 fontWeight: 600,
        //             },
        //         },
        //     },
        //     fill: {
        //         opacity: 1,
        //     },
        //     responsive: [{
        //         breakpoint: 1541,
        //         options: {
        //             chart: {
        //                 height: 233,
        //             },
        //             plotOptions: {
        //                 bar: {
        //                     columnWidth: "80%",
        //                 },
        //             },
        //             grid: {
        //                 padding: {
        //                     right: 0,
        //                 },
        //             },
        //         },
        //     }, ],
        // };
        // var chartvisitor = new ApexCharts(
        //     document.querySelector("#earnings-chart"),
        //     optionsvisitor
        // );
        // chartvisitor.render();

        const urlGetData = @json(route('dashboard.load-revenue-data'));
        const revenueChartsContainer = $('#revenue-charts-container');

        const createRevenueCharts = async (params = {}) => {
            const {
                data
            } = await http.get(urlGetData, params);

            revenueChartsContainer.empty();

            if (!$('#revenue-from').val())
                $('#revenue-from').val(data.from)
            if (!$('#revenue-to').val())
                $('#revenue-to').val(data.to)

            $.each(data.revenue, (index, value) => {
                const id = `revenue-${index}-chart`;
                revenueChartsContainer.append(
                    `
                        <div class="col-xl-6 col-lg-12 box-col-12">
                            <div class="card growthcard">
                                <div class="card-header card-no-border pb-0">
                                    <div class="header-top">
                                        <h3>${value.title}</h3>
                                        <h5>Tổng: ${formatNumber(value.sum)} VND</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0">
                                    <div id="${id}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                )
                createRevenueChart(id, value);
            })
        }

        const createRevenueChart = (id, data) => {
            data.days = data.days.map((value, index) => {
                return {
                    x: value.day,
                    y: value.sum,
                }
            })

            var options = {
                series: [{
                    name: "Tổng",
                    data: data.days,
                }, ],
                chart: {
                    type: "area",
                    height: 350,
                    animations: {
                        enabled: false,
                    },
                    zoom: {
                        enabled: false,
                    },
                    toolbar: {
                        show: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "straight",
                },
                grid: {
                    show: true,
                    borderColor: "#e5e5e5",
                },
                fill: {
                    opacity: 0.8,
                    type: "gradient",
                    gradient: {
                        shade: "light",
                        type: "vertical",
                        shadeIntensity: 0.5,
                        gradientToColors: undefined,
                        inverseColors: true,
                        opacityFrom: 1,
                        opacityTo: 0,
                        stops: [0, 100],
                        colorStops: [],
                    },
                },
                colors: [data.color],
                markers: {
                    size: 6,
                    colors: "var(--body-color)",
                    strokeColor: data.color,
                    strokeWidth: 3,
                    strokeOpacity: 1,
                    fillOpacity: 0,
                    hover: {
                        size: 9,
                    },
                },
                tooltip: {
                    intersect: true,
                    shared: false,
                },
                theme: {
                    palette: "palette1",
                },
                yaxis: {
                    categories: [
                        "000",
                        "100",
                        "200",
                        "300",
                        "400",
                        "500",
                        "300",
                        "400",
                        "500",
                    ],
                    labels: {
                        formatter: function(val) {
                            return formatNumber(val) + " VND";
                        },
                        style: {
                            fontSize: "13px",
                            fontFamily: "Nunito Sans, sans-serif",
                            colors: "#AAA3A0",
                            fontWeight: 600,
                        },
                    },
                },
                xaxis: {
                    labels: {
                        formatter: function(val) {
                            return formatDateTime(val);
                        },
                        style: {
                            fontSize: "13px",
                            fontFamily: "Nunito Sans', sans-serif",
                            colors: "#AAA3A0",
                            fontWeight: 600,
                        },
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                responsive: [{
                        breakpoint: 1400,
                        options: {
                            chart: {
                                height: 255,
                            },
                        },
                    },
                    {
                        breakpoint: 1321,
                        options: {
                            chart: {
                                height: 260,
                            },
                        },
                    },
                    {
                        breakpoint: 1252,
                        options: {
                            chart: {
                                height: 275,
                            },
                        },
                    },
                    {
                        breakpoint: 1200,
                        options: {
                            chart: {
                                height: 360,
                            },
                        },
                    },
                    {
                        breakpoint: 481,
                        options: {
                            chart: {
                                height: 260,
                                offsetY: 20,
                            },
                        },
                    },
                ],
            };
            var chart = new ApexCharts(document.querySelector(`#${id}`), options);
            chart.render();
        }

        $('#revenue-from, #revenue-from').on('change', () => {
            createRevenueCharts({
                from: $('#revenue-from').val(),
                to: $('#revenue-to').val(),
            })
        })
        const main = () => {
            createRevenueCharts()
        }

        $(document).ready(() => {
            main();
        })
    </script>
@endsection
