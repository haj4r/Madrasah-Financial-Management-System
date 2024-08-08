<!DOCTYPE html>
<html lang="en" style="height: 100%;">
<?php
session_start();
include "dbConnection.php";


$sql = "SELECT COUNT(*) as total FROM zakat";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalzakat = $row['total'];
} else {
    $totalzakat = 0;
}


$sql = "SELECT COUNT(*) as total FROM donation";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totaldo = $row['total'];
} else {
    $totaldo = 0;
}


$sql = "SELECT COUNT(*) as total FROM fees";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalf = $row['total'];
} else {
    $totalf = 0;
}


$mysqli->close();

?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/d21aa4c3aa.js" crossorigin="anonymous"></script>

    <title>Dashboard</title>
    <style>
        .content-wrapper {
            display: flex;
            height: 100vh;
        }

        .main-content {
            margin-left: 200px;
            flex-grow: 1;
            padding: 20px;
            background-color: #FFFFFF;
            overflow-y: auto;
        }

        .flat-select {
            width: auto;
            height: auto;
            font-size: 16px;
            padding: 10px 20px;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        .custom-input2 {
            border-radius: 6px;
            border-width: 1px;
            border-color: #bdbdbd;
            outline: none;
            background-color: rgba(255, 255, 255, 0.3);
            color: #4a4a4a;
        }

        .custom-input2::placeholder {
            color: #bdbdbd;
        }

        .hidden {
            display: none;
        }

        .tabs {
            margin-bottom: 1.5rem;
        }

        .file-label .icon {
            margin-left: 10px;
        }

        .image.is-128x128 {
            margin-bottom: 10px;
        }

        #remove-picture {
            margin-top: 10px;
            display: inline-block;
        }

        .tabs ul li.is-active a {
            border-color: #000;
            color: #000;
        }

        .tabs ul li a {
            color: #000;
        }

        .tabs ul li a:hover {
            background-color: #00b89c;
        }

        .tabs ul li.is-active.light-theme a {
            color: #000;
        }

        .button.is-custom {
            background-color: #3699FF;
            border-color: #fff;
            color: #fff;
        }

        .button.is-custom:hover,
        .button.custom.is-hovered {
            background-color: #ffff;
            border-color: #3699FF;
            color: #3699FF
        }

        .button.is-custom.is-outlined:hover,
        .button.is-custom.is-outlined.is-hovered,
        .button.is-custom.is-outlined:focus,
        .button.is-custom.is-outlined.is-focused {
            background-color: #fff;
            border-color: #fff;
            color: #3699FF
        }

        .button.is-custom2 {
            background-color: #7A97A9;
            border-color: #fff;
            color: #fff
        }

        .button.is-custom2:hover,
        .button.custom2.is-hovered {
            background-color: #fff;
            border-color: #7A97A9;
            color: #7A97A9
        }

        .button.is-custom2.is-outlined:hover,
        .button.is-custom2.is-outlined.is-hovered,
        .button.is-custom2.is-outlined:focus,
        .button.is-custom2.is-outlined.is-focused {
            background-color: #fff;
            border-color: #fff;
            color: #7A97A9
        }

        .button.is-custom3 {
            background-color: #36B538;
            border-color: #fff;
            color: #fff
        }

        .button.is-custom3:hover,
        .button.custom3.is-hovered {
            background-color: #fff;
            border-color: #36B538;
            color: #36B538
        }

        .button.is-custom3.is-outlined:hover,
        .button.is-custom3.is-outlined.is-hovered,
        .button.is-custom3.is-outlined:focus,
        .button.is-custom3.is-outlined.is-focused {
            background-color: #fff;
            border-color: #fff;
            color: #36B538
        }

        .button.is-custom4 {
            background-color: #384D6C;
            border-color: #fff;
            color: #fff;
        }

        .button.is-custom4:hover,
        .button.custom.is-hovered {
            background-color: #ffff;
            border-color: #384D6C;
            color: #384D6C
        }

        .button.is-custom4.is-outlined:hover,
        .button.is-custom4.is-outlined.is-hovered,
        .button.is-custom4.is-outlined:focus,
        .button.is-custom4.is-outlined.is-focused {
            background-color: #fff;
            border-color: #fff;
            color: #384D6C
        }

        .custom-bg {
            background: rgb(211, 217, 220);
            background: linear-gradient(0deg, rgba(211, 217, 220, 1) 0%, rgba(216, 104, 176, 1) 100%);
        }

        .custom-bg2 {
            background: rgb(221, 158, 97);
            background: linear-gradient(0deg, rgba(221, 158, 97, 1) 0%, rgba(174, 180, 250, 1) 100%);
        }

        .custom-bg3 {
            background: rgb(221, 158, 97);
            background: linear-gradient(0deg, rgba(221, 158, 97, 1) 0%, rgba(226, 158, 159, 1) 100%);
        }

        .custom-bg4 {
            background: rgb(235, 188, 160);
            background: linear-gradient(0deg, rgba(235, 188, 160, 1) 0%, rgba(208, 166, 253, 1) 100%);
        }

        .box {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100%;
            border-radius: 15px;
        }

        .custom-border img {
            width: 100%;
            height: 120%;
            object-fit: fit;
            border-radius: 15px;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
        }

        .position {
            margin-left: 120px;
            width: 100%;
        }

        #wrap {
            margin-left: 45px;
            margin-top: 65px;
            margin-bottom: 100px;
            max-width: 900px;
            position: relative;
        }

        .chart-box {
            padding-left: 0;
        }

        #chart-year {
            width: 50%;
            max-width: 80%;
            box-shadow: none;
            padding-left: 0;
            padding-top: 20px;
            background: #fff;
        }

        #chart-quarter {
            width: 50%;
            max-width: 90%;
            box-shadow: none;
            padding-left: 0;
            padding-top: 20px;
            background: #fff;
            border: 1px solid #ddd;
        }

        #chart-year {
            float: left;
            position: relative;
            transition: 1s ease transform;
            z-index: 3;
        }

        #chart-year.chart-quarter-activated {
            transform: translateX(0);
            transition: 1s ease transform;
        }

        #chart-quarter {
            float: left;
            position: relative;
        }

        #chart-quarter.active {
            transition: 1.1s ease-in-out transform;
            transform: translateX(0);
            z-index: 1;
        }

        @media screen and (min-width: 480px) {
            #chart-year {
                transform: translateX(50%);
            }

            #chart-quarter {
                transform: translateX(-50%);
            }
        }

        select#model {
            padding: 8px;
            background-color: #384D6C;
            border-color: #fff;
            border-radius: 5px;
            color: #fff;
            display: center;
            position: absolute;
            top: -40px;
            left: 0;
            z-index: 2;
            cursor: pointer;
            transform: scale(0.8);
        }
    </style>

    <script>
        window.Promise ||
            document.write(
                '<script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"><\/script>'
            )
        window.Promise ||
            document.write(
                '<script src="https://cdn.jsdelivr.net/npm/eligrey-classlist-js-polyfill@1.2.20171210/classList.min.js"><\/script>'
            )
        window.Promise ||
            document.write(
                '<script src="https://cdn.jsdelivr.net/npm/findindex_polyfill_mdn"><\/script>'
            )
    </script>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script>
        // Replace Math.random() with a pseudo-random number generator to get reproducible results in e2e tests
        // Based on https://gist.github.com/blixt/f17b47c62508be59987b
        var _seed = 42;
        Math.random = function() {
            _seed = _seed * 16807 % 2147483647;
            return (_seed - 1) / 2147483646;
        };
    </script>

    <script>
        Apex = {
            chart: {
                toolbar: {
                    show: false
                }
            },
            tooltip: {
                shared: false
            },
            legend: {
                show: false
            }
        }

        var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#00D9E9', '#FF66C3'];

        function shuffleArray(array) {
            for (var i = array.length - 1; i > 0; i--) {
                var j = Math.floor(Math.random() * (i + 1));
                var temp = array[i];
                array[i] = array[j];
                array[j] = temp;
            }
            return array;
        }

        var arrayData = [{
            y: 400,
            quarters: [{
                x: 'Q1',
                y: 120
            }, {
                x: 'Q2',
                y: 90
            }, {
                x: 'Q3',
                y: 100
            }, {
                x: 'Q4',
                y: 90
            }, ]
        }, {
            y: 430,
            quarters: [{
                x: 'Q1',
                y: 120
            }, {
                x: 'Q2',
                y: 110
            }, {
                x: 'Q3',
                y: 90
            }, {
                x: 'Q4',
                y: 110
            }]
        }, {
            y: 448,
            quarters: [{
                x: 'Q1',
                y: 70
            }, {
                x: 'Q2',
                y: 100
            }, {
                x: 'Q3',
                y: 140
            }, {
                x: 'Q4',
                y: 138
            }]
        }, {
            y: 470,
            quarters: [{
                x: 'Q1',
                y: 150
            }, {
                x: 'Q2',
                y: 60
            }, {
                x: 'Q3',
                y: 190
            }, {
                x: 'Q4',
                y: 70
            }]
        }, {
            y: 540,
            quarters: [{
                x: 'Q1',
                y: 120
            }, {
                x: 'Q2',
                y: 120
            }, {
                x: 'Q3',
                y: 130
            }, {
                x: 'Q4',
                y: 170
            }]
        }, {
            y: 580,
            quarters: [{
                x: 'Q1',
                y: 170
            }, {
                x: 'Q2',
                y: 130
            }, {
                x: 'Q3',
                y: 120
            }, {
                x: 'Q4',
                y: 160
            }]
        }];

        function makeData() {
            var dataSet = shuffleArray(arrayData)

            var dataYearSeries = [{
                x: "2011",
                y: dataSet[0].y,
                color: colors[0],
                quarters: dataSet[0].quarters
            }, {
                x: "2012",
                y: dataSet[1].y,
                color: colors[1],
                quarters: dataSet[1].quarters
            }, {
                x: "2013",
                y: dataSet[2].y,
                color: colors[2],
                quarters: dataSet[2].quarters
            }, {
                x: "2014",
                y: dataSet[3].y,
                color: colors[3],
                quarters: dataSet[3].quarters
            }, {
                x: "2015",
                y: dataSet[4].y,
                color: colors[4],
                quarters: dataSet[4].quarters
            }, {
                x: "2016",
                y: dataSet[5].y,
                color: colors[5],
                quarters: dataSet[5].quarters
            }];

            return dataYearSeries
        }

        function updateQuarterChart(sourceChart, destChartIDToUpdate) {
            var series = [];
            var seriesIndex = 0;
            var colors = []

            if (sourceChart.w.globals.selectedDataPoints[0]) {
                var selectedPoints = sourceChart.w.globals.selectedDataPoints;
                for (var i = 0; i < selectedPoints[seriesIndex].length; i++) {
                    var selectedIndex = selectedPoints[seriesIndex][i];
                    var yearSeries = sourceChart.w.config.series[seriesIndex];
                    series.push({
                        name: yearSeries.data[selectedIndex].x,
                        data: yearSeries.data[selectedIndex].quarters
                    })
                    colors.push(yearSeries.data[selectedIndex].color)
                }

                if (series.length === 0) series = [{
                    data: []
                }]

                return ApexCharts.exec(destChartIDToUpdate, 'updateOptions', {
                    series: series,
                    colors: colors,
                    fill: {
                        colors: colors
                    }
                })
            }
        }
    </script>
</head>

<body data-theme="light">
    <div class="content-wrapper">
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <div class="columns m-0 p-0">
                <div class="column is-half">
                    <div class="custom-border pl-6 pt-5 pb-0" style="height: 80%;">
                        <img src="assets/banner.png" alt="Banner Image">
                    </div>
                </div>
                <div class="column is-half">
                    <div class="custom-border p-3" style="height: 100%;">
                        <label class="has-text-weight-semibold has-text-grey p-2">
                            Today's Summary
                        </label>
                        <div class="columns is-multiline m-0 p-0">
                            <div class="column is-half">
                                <div class="box custom-bg">
                                    <div class="is-size-5 fas fa-user-graduate has-text-grey"></div>
                                    <p class="has-text-grey has-text-weight-semibold"><?php echo $totalzakat; ?></p>
                                    <p class="has-text-grey is-size-7">Total people who paid Zakat</p>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="box custom-bg2">
                                    <div class="is-size-5 fas fa-book-open-reader has-text-grey"></div>
                                    <p class="has-text-grey has-text-weight-semibold"><?php echo $totaldo; ?></p>
                                    <p class="has-text-grey is-size-7">Total people who donates</p>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="box custom-bg3">
                                    <div class="is-size-5 fas fa-book-open-reader has-text-grey"></div>
                                    <p class="has-text-grey has-text-weight-semibold"><?php echo $totalf; ?></p>
                                    <p class="has-text-grey is-size-7">Total people who paid fees</p>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="box custom-bg4">
                                    <div class="is-size-5 fas fa-list-check has-text-grey"></div>
                                    <p class="has-text-grey has-text-weight-semibold"><?php echo $totalzakat + $totalf + $totaldo; ?></p>
                                    <p class="has-text-grey is-size-7">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="position">
                <div id="wrap">
                    <select id="model" class="flat-select">
                        <option value="Zakat">Zakat</option>
                        <option value="Donation">Donation</option>
                        <option value="Fees">Fees</option>
                    </select>
                    <div id="chart-year"></div>
                    <div id="chart-quarter"></div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var options = {
            series: [{
                data: makeData()
            }],
            chart: {
                id: 'barYear',
                height: 400,
                width: '100%',
                type: 'bar',
                events: {
                    dataPointSelection: function(e, chart, opts) {
                        var quarterChartEl = document.querySelector("#chart-quarter");
                        var yearChartEl = document.querySelector("#chart-year");

                        if (opts.selectedDataPoints[0].length === 1) {
                            if (quarterChartEl.classList.contains("active")) {
                                updateQuarterChart(chart, 'barQuarter')
                            } else {
                                yearChartEl.classList.add("chart-quarter-activated")
                                quarterChartEl.classList.add("active");
                                updateQuarterChart(chart, 'barQuarter')
                            }
                        } else {
                            updateQuarterChart(chart, 'barQuarter')
                        }

                        if (opts.selectedDataPoints[0].length === 0) {
                            yearChartEl.classList.remove("chart-quarter-activated")
                            quarterChartEl.classList.remove("active");
                        }

                    },
                    updated: function(chart) {
                        updateQuarterChart(chart, 'barQuarter')
                    }
                }
            },
            plotOptions: {
                bar: {
                    distributed: true,
                    horizontal: true,
                    barHeight: '75%',
                    dataLabels: {
                        position: 'bottom'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                style: {
                    colors: ['#fff']
                },
                formatter: function(val, opt) {
                    return opt.w.globals.labels[opt.dataPointIndex]
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
            },

            colors: colors,

            states: {
                normal: {
                    filter: {
                        type: 'desaturate'
                    }
                },
                active: {
                    allowMultipleDataPointsSelection: true,
                    filter: {
                        type: 'darken',
                        value: 1
                    }
                }
            },
            tooltip: {
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function(val, opts) {
                            return opts.w.globals.labels[opts.dataPointIndex]
                        }
                    }
                }
            },
            title: {
                text: 'Yearly Results',
                offsetX: 15
            },
            subtitle: {
                text: '(Click on bar to see details and click multiple bars for comparison)',
                offsetX: 15
            },
            yaxis: {
                labels: {
                    show: false
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart-year"), options);
        chart.render();

        var optionsQuarter = {
            series: [{
                data: []
            }],
            chart: {
                id: 'barQuarter',
                height: 400,
                width: '100%',
                type: 'bar',
                stacked: true
            },
            plotOptions: {
                bar: {
                    columnWidth: '50%',
                    horizontal: false
                }
            },
            legend: {
                show: false
            },
            grid: {
                yaxis: {
                    lines: {
                        show: false,
                    }
                },
                xaxis: {
                    lines: {
                        show: true,
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            title: {
                text: 'Quarterly Results',
                offsetX: 10
            },
            tooltip: {
                x: {
                    formatter: function(val, opts) {
                        return opts.w.globals.seriesNames[opts.seriesIndex]
                    }
                },
                y: {
                    title: {
                        formatter: function(val, opts) {
                            return opts.w.globals.labels[opts.dataPointIndex]
                        }
                    }
                }
            }
        };

        var chartQuarter = new ApexCharts(document.querySelector("#chart-quarter"), optionsQuarter);
        chartQuarter.render();


        chart.addEventListener('dataPointSelection', function(e, chart, opts) {
            var quarterChartEl = document.querySelector("#chart-quarter");
            var yearChartEl = document.querySelector("#chart-year");

            if (opts.selectedDataPoints[0].length === 1) {
                if (quarterChartEl.classList.contains("active")) {
                    updateQuarterChart(chart, 'barQuarter')
                } else {
                    yearChartEl.classList.add("chart-quarter-activated")
                    quarterChartEl.classList.add("active");
                    updateQuarterChart(chart, 'barQuarter')
                }
            } else {
                updateQuarterChart(chart, 'barQuarter')
            }

            if (opts.selectedDataPoints[0].length === 0) {
                yearChartEl.classList.remove("chart-quarter-activated")
                quarterChartEl.classList.remove("active");
            }

        })

        chart.addEventListener('updated', function(chart) {
            updateQuarterChart(chart, 'barQuarter')
        })

        document.querySelector("#model").addEventListener("change", function(e) {
            chart.updateSeries([{
                data: makeData()
            }])
        })
    </script>

</body>

</html>