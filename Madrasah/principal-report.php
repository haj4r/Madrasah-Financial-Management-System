<!DOCTYPE html>
<html lang="en" style="height: 100%;">

<?php
session_start();
include "dbConnection.php";
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://kit.fontawesome.com/d21aa4c3aa.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title>Report</title>
  <style>
    .content-wrapper {
      display: flex;
      height: 100vh;
    }

    .main-content {
      margin-left: 200px;
      flex-grow: 1;
      padding: 40px;
      background-color: #FFFFFF;
      overflow-y: auto;
    }

    .chart-container {
      display: flex;
      width: 100%;
      margin-top: 20px;
      margin-left: 150px;
      border: 1% solid#ccc;
    }

    #chart5 {
      flex: 3;
      max-width: 93%;
    }

    .chart-container2 {
      display: flex;
      width: 100%;
      border: 2px #ccc;
      border-radius: 10%;
      background-color: #fff;
    }

    .chart-wrapper {
      flex: 1;
      max-width: 20%;
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .flat-select {
      width: auto;
      height: auto;
      font-size: 16px;
      padding: 10px 20px;
      border: 2px solid #ccc;
      border-radius: 5px;
    }


    .box-container3 {
      border: 1px solid #ddd;
      padding: 4px;
      margin: 30px;
      margin-top: 20px;
      margin-left: 40px;
      border-radius: 10px;
    }

    .box-container1 {
      border: 1px solid #ddd;
      padding: 4px;
      margin: 30px;
      margin-top: 20px;
      margin-left: 90px;
      border-radius: 10px;
    }

    .box-container2 {
      border: 1px solid #ddd;
      padding: 4px;
      margin: 30px;
      margin-top: 20px;
      margin-left: 40px;
      border-radius: 10px;
    }

    .graphs-container {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .graph {
      margin: 0 15px;
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
      display: flex;
    }

    .chart-box {
      padding-left: 0;
    }

    #chart-year {
      width: 80%;
      max-width: 80%;
      box-shadow: none;
      padding-left: 0;
      padding-top: 20px;
      background: #fff;
    }

    #chart-quarter {
      width: 80%;
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

    .centered-heading {
      text-align: center;
      width: 100%;
      margin: 0 auto;
    }

    @media screen and (min-width: 480px) {
      #chart-year {
        transform: translateX(50%);
      }

      #chart-quarter {
        transform: translateX(-50%);
      }
    }

    .table-container {
      width: 100%;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;

    }

    .section {
      width: 100%;
    }

    .container-report{
      width: 100%;
      border: 2px solid #ddd;
      border-radius: 10px;
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
</head>

<body data-theme="light">
  <div class="content-wrapper">
    <?php include 'sidebar.php'; ?>
    <div class="main-content">
      <h1 class="is-size-3 pl-6 has-text-weight-bold"> Report Summary</h1><br>
      <div class="container">
        <h1 class="is-size-4 pl-6 has-text-weight-bold centered-heading"> Achievement Target</h1><br>
        <div class="graphs-container">
          <div class="chart-container2">
            <div class="box-container1">
              <div id="chart2"></div>
            </div>
            <div class="box-container2">
              <div id="chart3"></div>
            </div>
            <div class="box-container3">
              <div id="chart4"></div>
            </div>
          </div>
        </div>
        
          <div class="container-report">
            <div class="custom-border p-3 ">
              <div class="is-flex is-justify-content-space-between is-align-items-center ">
                <div>
                  <h2 class="has-text-weight-bold is-size-3">Report Transaction</h2>
                </div>
              </div>
              <div class="filter-container">
                <form id="filterForm">
                  <div style="display: flex">
                    <div class="field">
                      <label class="label" for="filter_type">Filter by Type</label>
                      <div class="control">
                        <div class="select" style="margin-right:25px">
                          <select name="filter_type" id="filter_type">
                            <option value="">All</option>
                            <?php
                            // Fetch types for the dropdown
                            require_once("dbConnection.php");
                            $typeResult = mysqli_query($mysqli, "SELECT * FROM type");
                            while ($typeRow = mysqli_fetch_assoc($typeResult)) {
                              echo "<option value='" . $typeRow['type_id'] . "'>" . $typeRow['type_name'] . "</option>";
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="field">
                      <label class="label" for="filter_month">Filter by Month</label>
                      <div class="control">
                        <input type="month" name="filter_month" id="filter_month" class="input">
                      </div>
                    </div>
                    <div class="field">
                      <label class="label" for="button">&nbsp</label>
                      <div class="control">
                        <button type="button" id="submit_filter" class="button is-link" style="margin-left:25px">Filter</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>



              <div class="table-container">
                <table class="table is-striped is-fullwidth">
                  <thead>
                    <tr>
                      <th>Serial No</th>

                      <th>Sender Name</th>
                      <th>Medium</th>
                      <th>Type</th>
                      <th>Date</th>
                      <th>Amount(Debit)</th>
                    </tr>
                  </thead>

                  <tbody id="transactionTableBody">
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="5"><strong>Total Amount:</strong></td>
                      <td id="totalAmount"><strong>RM </strong></td>
                    </tr>
                  </tfoot>

                </table>
              </div>
            </div>
          </div>
       

      </div>

    </div>
  </div>

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
    $(document).ready(function() {
      function fetchFilteredData() {
        const filterType = $('#filter_type').val();
        const filterMonth = $('#filter_month').val();

        $.ajax({
          url: 'filterTransactions.php',
          method: 'POST',
          data: {
            filter_type: filterType,
            filter_month: filterMonth
          },
          success: function(response) {
            const data = JSON.parse(response);
            const transactions = data.transactions;
            const totalAmount = data.totalAmount;

            let tableBody = '';
            transactions.forEach(transaction => {
              tableBody += `
                                <tr>
                                    <td>${transaction.trans_id}</td>
                                    <td>${transaction.sender_name}</td>
                                    <td>${transaction.trans_medium}</td>
                                    <td>${transaction.type_name}</td>
                                    <td>${transaction.date}</td>
                                    <td>${transaction.amount}</td>
                                </tr>
                            `;
            });

            $('#transactionTableBody').html(tableBody);
            $('#totalAmount').html(`<strong>RM ${totalAmount}</strong>`);
          }
        });
      }

      $('#submit_filter').on('click', function() {
        fetchFilteredData();
      });

      // Initial load
      fetchFilteredData();
    });
  </script>

  <script>
    var _seed = 42;
    Math.random = function() {
      _seed = _seed * 16807 % 2147483647;
      return (_seed - 1) / 2147483646;
    };
  </script>
  <script>
    var options2 = {
      series: [75],
      chart: {
        height: 300,
        type: 'radialBar',
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          type: 'horizontal',
          shadeIntensity: 0.5,
          gradientToColors: ['#ABE5A1'],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        }
      },
      stroke: {
        lineCap: 'round',
        width: 2,
        colors: ['#000000']
      },
      labels: ['Zakat'],
    };

    var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
    chart2.render();
  </script>
  <script>
    var options3 = {
      series: [55],
      chart: {
        height: 300,
        type: 'radialBar'
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          type: 'horizontal',
          shadeIntensity: 0.5,
          gradientToColors: ['#ABE5A1'],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        }
      },
      stroke: {
        lineCap: 'round',
        width: 2,
        colors: ['#000000']
      },
      labels: ['Fees'],
    };

    var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
    chart3.render();
  </script>
  <script>
    var options4 = {
      series: [25],
      chart: {
        height: 300,
        type: 'radialBar',
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          type: 'horizontal',
          shadeIntensity: 0.5,
          gradientToColors: ['#ABE5A1'],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 1,
          stops: [0, 100]
        }
      },
      stroke: {
        lineCap: 'round',
        width: 2,
        colors: ['#000000']
      },
      labels: ['Donation'],
    };

    var chart4 = new ApexCharts(document.querySelector("#chart4"), options4);
    chart4.render();
  </script>
  <!-- bar chart -->
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