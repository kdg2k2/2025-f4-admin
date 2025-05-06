(function() {
    // visitor chart
    var optionsvisitor = {
        series: [{
                name: "Active",
                data: [5000, 6000, 7800, 4000, 5000],
            },
            {
                name: "Bounce",
                data: [8000, 9600, 5600, 9000, 8000],
            },
        ],
        chart: {
            type: "bar",
            height: 225,
            offsetX: -20,
            offsetY: 10,
            toolbar: {
                show: false,
            },
        },
        legend: {
            show: false,
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "75%",
                borderRadius: 2,
            },
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            show: true,
            width: 6,
            colors: ["transparent"],
        },
        grid: {
            show: true,
            borderColor: "#e5e5e5",
            xaxis: {
                lines: {
                    show: false,
                },
            },
            yaxis: {
                lines: {
                    show: true,
                },
            },
        },
        colors: [AdmiroAdminConfig.secondary, AdmiroAdminConfig.primary],
        xaxis: {
            categories: ["Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
            tickAmount: 4,
            tickPlacement: "between",
            labels: {
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
        yaxis: {
            categories: ["2000", "4000", "6000", "8000", "10 000"],
            labels: {
                formatter: function(val) {
                    return val;
                },
                style: {
                    fontSize: "13px",
                    fontFamily: "Nunito Sans, sans-serif",
                    colors: "#AAA3A0",
                    fontWeight: 600,
                },
            },
        },
        fill: {
            opacity: 1,
        },
        responsive: [{
            breakpoint: 1541,
            options: {
                chart: {
                    height: 233,
                },
                plotOptions: {
                    bar: {
                        columnWidth: "80%",
                    },
                },
                grid: {
                    padding: {
                        right: 0,
                    },
                },
            },
        }, ],
    };
    var chartvisitor = new ApexCharts(
        document.querySelector("#earnings-chart"),
        optionsvisitor
    );
    chartvisitor.render();


    ///growth-chart
    var options = {
        series: [{
            name: "Tiêu chí",
            data: [{
                    x: "T1",
                    y: 350,
                },
                {
                    x: "T2",
                    y: 600,
                },
                {
                    x: "T3",
                    y: 350,
                },
                {
                    x: "T4",
                    y: 410,
                },
                {
                    x: "T5",
                    y: 410,
                },
                {
                    x: "T6",
                    y: 600,
                },
                {
                    x: "T7",
                    y: 500,
                },
                {
                    x: "T8",
                    y: 500,
                },
                {
                    x: "T9",
                    y: 800,
                },
                {
                    x: "T10",
                    y: 410,
                },
                {
                    x: "T11",
                    y: 350,
                },
                {
                    x: "T12",
                    y: 410,
                },
            ],
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
        colors: [AdmiroAdminConfig.primary],
        markers: {
            size: 6,
            colors: "var(--body-color)",
            strokeColor: AdmiroAdminConfig.primary,
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
                    return val;
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
    var chart = new ApexCharts(document.querySelector("#growth-chart"), options);
    chart.render();
})();
