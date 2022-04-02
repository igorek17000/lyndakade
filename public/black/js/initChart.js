function convert_to_array(json_data) {
    var result = [];
    for (var i in json_data) result.push(json_data[i]);
    return result;
}

function addCommas(nStr) {
    nStr += "";
    var x = nStr.split(".");
    var x1 = x[0];
    var x2 = x.length > 1 ? "." + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, "$1" + "," + "$2");
    }
    return x1 + x2;
}

function get_chart_data(days, url) {
    var result = "";
    $.ajax({
        url: url,
        method: "post",
        data: { days: days, _token: $('input[name="_token"]').val() },
        async: false,
        success: function(data) {
            result = data;
            console.log(result);
        },
        error: function(xhr, status, error) {
            console.log({ xhr: xhr, status: status, error: error });
        }
    });
    return result;
}

function get_views_for_last_days(days = 7) {
    return get_chart_data(days, "https://lyndakade.ir/data/get-views-for-days");
}

function get_purchases_count_for_last_days(days = 7) {
    return get_chart_data(
        days,
        "https://lyndakade.ir/data/get-purchases-count-for-days"
    );
}

function get_purchases_price_for_last_days(days = 7) {
    return get_chart_data(
        days,
        "https://lyndakade.ir/data/get-purchases-price-for-days"
    );
}

$(function() {
    // Chart.defaults.global.tooltipTemplate = "<%= addCommas(value) %>";

    gradientChartOptionsConfigurationWithTooltipBlue = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },
        tooltips: {
            backgroundColor: "#f5f5f5",
            titleFontColor: "#333",
            bodyFontColor: "#666",
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
        },
        responsive: true,
        scales: {
            yAxes: [
                {
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(29,140,248,0.0)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#2380f7"
                    }
                }
            ],

            xAxes: [
                {
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(29,140,248,0.1)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#2380f7"
                    }
                }
            ]
        }
    };

    gradientChartOptionsConfigurationWithTooltipPurple = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },

        tooltips: {
            backgroundColor: "#f5f5f5",
            titleFontColor: "#333",
            bodyFontColor: "#666",
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
        },
        responsive: true,
        scales: {
            yAxes: [
                {
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(29,140,248,0.0)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }
            ],

            xAxes: [
                {
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(225,78,202,0.1)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9a9a9a"
                    }
                }
            ]
        }
    };

    gradientChartOptionsConfigurationWithTooltipOrange = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },

        tooltips: {
            backgroundColor: "#f5f5f5",
            titleFontColor: "#333",
            bodyFontColor: "#666",
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
        },
        responsive: true,
        scales: {
            yAxes: [
                {
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(29,140,248,0.0)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        suggestedMin: 50,
                        suggestedMax: 110,
                        padding: 20,
                        fontColor: "#ff8a76"
                    }
                }
            ],

            xAxes: [
                {
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(220,53,69,0.1)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#ff8a76"
                    }
                }
            ]
        }
    };

    gradientChartOptionsConfigurationWithTooltipGreen = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },

        tooltips: {
            backgroundColor: "#f5f5f5",
            titleFontColor: "#333",
            bodyFontColor: "#666",
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
        },
        responsive: true,
        scales: {
            yAxes: [
                {
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(29,140,248,0.0)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        suggestedMin: 50,
                        suggestedMax: 125,
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }
            ],

            xAxes: [
                {
                    barPercentage: 1.6,
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(0,242,195,0.1)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }
            ]
        }
    };

    gradientBarChartConfiguration = {
        maintainAspectRatio: false,
        legend: {
            display: false
        },

        tooltips: {
            backgroundColor: "#f5f5f5",
            titleFontColor: "#333",
            bodyFontColor: "#666",
            bodySpacing: 4,
            xPadding: 12,
            mode: "nearest",
            intersect: 0,
            position: "nearest"
        },
        responsive: true,
        scales: {
            yAxes: [
                {
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(29,140,248,0.1)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        suggestedMin: 60,
                        suggestedMax: 120,
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }
            ],

            xAxes: [
                {
                    gridLines: {
                        drawBorder: false,
                        color: "rgba(29,140,248,0.1)",
                        zeroLineColor: "transparent"
                    },
                    ticks: {
                        padding: 20,
                        fontColor: "#9e9e9e"
                    }
                }
            ]
        }
    };

    // var ctx = document.getElementById("chartLinePurple").getContext("2d");
    // var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
    // gradientStroke.addColorStop(1, 'rgba(72,72,176,0.2)');
    // gradientStroke.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    // gradientStroke.addColorStop(0, 'rgba(119,52,169,0)'); //purple colors
    // var data = {
    //     labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
    //     datasets: [{
    //         label: "Data",
    //         fill: true,
    //         backgroundColor: gradientStroke,
    //         borderColor: '#d048b6',
    //         borderWidth: 2,
    //         borderDash: [],
    //         borderDashOffset: 0.0,
    //         pointBackgroundColor: '#d048b6',
    //         pointBorderColor: 'rgba(255,255,255,0)',
    //         pointHoverBackgroundColor: '#d048b6',
    //         pointBorderWidth: 20,
    //         pointHoverRadius: 4,
    //         pointHoverBorderWidth: 15,
    //         pointRadius: 4,
    //         data: [80, 100, 70, 80, 120, 80],
    //     }]
    // };
    // var myChart = new Chart(ctx, {
    //     type: 'line',
    //     data: data,
    //     options: gradientChartOptionsConfigurationWithTooltipPurple
    // });

    // var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");
    // var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
    // gradientStroke.addColorStop(1, 'rgba(66,134,121,0.15)');
    // gradientStroke.addColorStop(0.4, 'rgba(66,134,121,0.0)'); //green colors
    // gradientStroke.addColorStop(0, 'rgba(66,134,121,0)'); //green colors
    // var data = {
    //     labels: ['JUL', 'AUG', 'SEP', 'OCT', 'NOV'],
    //     datasets: [{
    //         label: "My First dataset",
    //         fill: true,
    //         backgroundColor: gradientStroke,
    //         borderColor: '#00d6b4',
    //         borderWidth: 2,
    //         borderDash: [],
    //         borderDashOffset: 0.0,
    //         pointBackgroundColor: '#00d6b4',
    //         pointBorderColor: 'rgba(255,255,255,0)',
    //         pointHoverBackgroundColor: '#00d6b4',
    //         pointBorderWidth: 20,
    //         pointHoverRadius: 4,
    //         pointHoverBorderWidth: 15,
    //         pointRadius: 4,
    //         data: [90, 27, 60, 12, 80],
    //     }]
    // };
    // var myChart = new Chart(ctxGreen, {
    //     type: 'line',
    //     data: data,
    //     options: gradientChartOptionsConfigurationWithTooltipGreen
    //
    // });

    var days = 30;

    if (window.screen.width < 500) {
        days = 7;
    }

    var result_data = get_views_for_last_days(days);
    var chart_labels = convert_to_array(result_data.label);
    var chart_data = convert_to_array(result_data.data);
    $("#charBig1TotalViewLastMonth").html(result_data.total);
    $("#charBig1TotalViewAllTime").html(result_data.all_time);
    $("#chart-total-purchase").hide();
    $("#chart-total-view").show();

    // var chart_labels = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
    // var chart_data = [100, 70, 90, 70, 85, 60, 75, 60, 90, 80, 110, 100];

    var ctx = document.getElementById("chartBig1").getContext("2d");
    var color = [
        "#ff6384",
        "#5959e6",
        "#2babab",
        "#8c4d15",
        "#8bc34a",
        "#607d8b",
        "#009688"
    ];

    var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

    gradientStroke.addColorStop(1, "rgba(72,72,176,0.1)");
    gradientStroke.addColorStop(0.4, "rgba(72,72,176,0.0)");
    gradientStroke.addColorStop(0, "rgba(119,52,169,0)"); //purple colors
    var config = {
        type: "line",
        data: {
            labels: chart_labels,
            datasets: [
                {
                    label: "Views",
                    fill: true,
                    backgroundColor: gradientStroke,
                    borderColor: "#d346b1",
                    borderWidth: 2,
                    borderDash: [],
                    borderDashOffset: 0.0,
                    pointBackgroundColor: "#d346b1",
                    pointBorderColor: "rgba(255,255,255,0)",
                    pointHoverBackgroundColor: "#d346b1",
                    pointBorderWidth: 20,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 15,
                    pointRadius: 4,
                    data: chart_data
                }
            ]
        },
        options: {
            maintainAspectRatio: false,
            legend: {
                display: true,
                position: "top"
            },
            tooltips: {
                backgroundColor: "#f5f5f5",
                titleFontColor: "#333",
                bodyFontColor: "#666",
                bodySpacing: 4,
                xPadding: 12,
                mode: "nearest",
                intersect: 0,
                position: "nearest",

                // Disable the on-canvas tooltip
                enabled: false,

                custom: function(tooltipModel) {
                    // Tooltip Element
                    var tooltipEl = document.getElementById("chartjs-tooltip");

                    // Create element on first render
                    if (!tooltipEl) {
                        tooltipEl = document.createElement("div");
                        tooltipEl.id = "chartjs-tooltip";
                        tooltipEl.innerHTML = "<table></table>";
                        document.body.appendChild(tooltipEl);
                    }

                    // Hide if no tooltip
                    if (tooltipModel.opacity === 0) {
                        tooltipEl.style.opacity = 0;
                        return;
                    }

                    // Set caret Position
                    tooltipEl.classList.remove(
                        "above",
                        "below",
                        "no-transform"
                    );
                    if (tooltipModel.yAlign) {
                        tooltipEl.classList.add(tooltipModel.yAlign);
                    } else {
                        tooltipEl.classList.add("no-transform");
                    }

                    function getBody(bodyItem) {
                        return bodyItem.lines;
                    }

                    // Set Text
                    if (tooltipModel.body) {
                        var titleLines = tooltipModel.title || [];
                        var bodyLines = tooltipModel.body.map(getBody);

                        var innerHtml = "<thead>";

                        titleLines.forEach(function(title) {
                            innerHtml += "<tr><th>" + title + "</th></tr>";
                        });
                        innerHtml += "</thead><tbody>";

                        bodyLines.forEach(function(body, i) {
                            var colors = tooltipModel.labelColors[i];
                            var style = "background:" + colors.backgroundColor;
                            style += "; border-color:" + colors.borderColor;
                            style += "; border-width: 2px";
                            var span = '<span style="' + style + '"></span>';
                            // innerHtml += '<tr><td>' + span + body + '</td></tr>';
                            innerHtml +=
                                "<tr><td>" +
                                span +
                                addCommas(body) +
                                "</td></tr>";
                        });
                        innerHtml += "</tbody>";

                        var tableRoot = tooltipEl.querySelector("table");
                        tableRoot.innerHTML = innerHtml;
                    }

                    // `this` will be the overall tooltip
                    var position = this._chart.canvas.getBoundingClientRect();

                    // Display, position, and set styles for font
                    tooltipEl.style.opacity = 1;
                    tooltipEl.style.position = "absolute";
                    tooltipEl.style.backgroundColor = "#f5f5f5";
                    tooltipEl.style.paddingLeft = "12px";
                    tooltipEl.style.paddingRight = "12px";
                    tooltipEl.style.left =
                        position.left +
                        window.pageXOffset +
                        tooltipModel.caretX +
                        "px";
                    tooltipEl.style.top =
                        position.top +
                        window.pageYOffset +
                        tooltipModel.caretY +
                        "px";
                    tooltipEl.style.fontFamily = tooltipModel._bodyFontFamily;
                    tooltipEl.style.fontSize = tooltipModel.bodyFontSize + "px";
                    tooltipEl.style.fontStyle = tooltipModel._bodyFontStyle;
                    tooltipEl.style.padding =
                        tooltipModel.yPadding +
                        "px " +
                        tooltipModel.xPadding +
                        "px";
                    tooltipEl.style.pointerEvents = "none";
                }
            },

            // tooltipTemplate: "<%= addCommas(value) %>",
            responsive: true,
            scales: {
                yAxes: [
                    {
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "left",
                        id: "y-axis-1",
                        gridLines: {
                            // drawOnChartArea: false, // only want the grid lines for one axis to show up
                            drawBorder: false,
                            color: "rgba(29,140,248,0.0)",
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            suggestedMin: 60,
                            suggestedMax: 100,
                            padding: 20,
                            fontColor: "#9a9a9a"
                        }
                    },
                    {
                        type: "linear", // only linear but allow scale type registration. This allows extensions to exist solely for log scale for instance
                        display: true,
                        position: "right",
                        id: "y-axis-2",

                        gridLines: {
                            // drawOnChartArea: false, // only want the grid lines for one axis to show up
                            drawBorder: false,
                            color: "rgba(29,140,248,0.0)",
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            suggestedMin: 60,
                            suggestedMax: 100,
                            padding: 20,
                            fontColor: "#9a9a9a",
                            callback: function(value, index, values) {
                                return addCommas(value);
                                // return '$' + value;
                            }
                        }
                    }
                    //     {
                    //     barPercentage: 1.6,
                    //     gridLines: {
                    //         drawBorder: false,
                    //         color: 'rgba(29,140,248,0.0)',
                    //         zeroLineColor: "transparent",
                    //     },
                    //     ticks: {
                    //         suggestedMin: 60,
                    //         suggestedMax: 125,
                    //         padding: 20,
                    //         fontColor: "#9a9a9a"
                    //     }
                    // }
                ],

                xAxes: [
                    {
                        barPercentage: 1.6,
                        gridLines: {
                            drawBorder: false,
                            color: "rgba(225,78,202,0.1)",
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 20,
                            fontColor: "#9a9a9a"
                        }
                    }
                ]
            }
        }
        // options: gradientChartOptionsConfigurationWithTooltipPurple
    };
    var myChartData = new Chart(ctx, config);
    $("#update-chart-views").click(function() {
        $("#chart-total-purchase").hide();
        $("#chart-total-view").show();
        var data = myChartData.config.data;

        var result_data = get_views_for_last_days(days);
        data.datasets = [
            {
                label: "Views",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: color[0],
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: color[0],
                pointBorderColor: "rgba(255,255,255,0)",
                pointHoverBackgroundColor: color[0],
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: convert_to_array(result_data.data)
            }
        ];
        data.labels = convert_to_array(result_data.label);
        data.datasets[0].label = $(this)
            .text()
            .trim();

        $("#charBig1TotalViewLastMonth").html(addCommas(result_data.total));
        $("#charBig1TotalViewAllTime").html(addCommas(result_data.all_time));

        myChartData.update();
    });
    $("#update-chart-purchase").click(function() {
        var data = myChartData.config.data;
        $("#chart-total-purchase").show();
        $("#chart-total-view").hide();

        var result_data = get_purchases_count_for_last_days(days);

        data.datasets = [
            {
                label: "Count",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: color[0],
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: color[0],
                pointBorderColor: "rgba(255,255,255,0)",
                pointHoverBackgroundColor: color[0],
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: convert_to_array(result_data.data_count),
                yAxisID: "y-axis-1"
            },
            {
                label: "Sold Price",
                fill: true,
                backgroundColor: gradientStroke,
                borderColor: color[1],
                borderWidth: 2,
                borderDash: [],
                borderDashOffset: 0.0,
                pointBackgroundColor: color[1],
                pointBorderColor: "rgba(255,255,255,0)",
                pointHoverBackgroundColor: color[1],
                pointBorderWidth: 20,
                pointHoverRadius: 4,
                pointHoverBorderWidth: 15,
                pointRadius: 4,
                data: convert_to_array(result_data.data_price),
                yAxisID: "y-axis-2"
            }
        ];

        data.labels = convert_to_array(result_data.label);
        $("#charBig1TotalCountLastMonth").html(
            addCommas(result_data.total_count)
        );
        $("#charBig1TotalCountAllTime").html(
            addCommas(result_data.all_time_count)
        );
        $("#charBig1TotalPriceLastMonth").html(
            addCommas(result_data.total_price)
        );
        $("#charBig1TotalPriceAllTime").html(
            addCommas(result_data.all_time_price)
        );

        myChartData.update();
    });

    $("#2").click(function () {
        var data = myChartData.config.data;

        var result_data = get_purchases_price_for_last_days(days);
        data.datasets[0].data = convert_to_array(result_data.data);
        data.labels = convert_to_array(result_data.label);
        data.datasets[0].label = $(this).text().trim();
        $('#charBig1TotalLastMonth').html(result_data.total);
        $('#charBig1TotalAllTime').html(result_data.all_time);

        myChartData.update();
    });

    // var ctx = document.getElementById("CountryChart").getContext("2d");
    //
    // var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);
    //
    // gradientStroke.addColorStop(1, 'rgba(29,140,248,0.2)');
    // gradientStroke.addColorStop(0.4, 'rgba(29,140,248,0.0)');
    // gradientStroke.addColorStop(0, 'rgba(29,140,248,0)'); //blue colors
    //
    //
    // var myChart = new Chart(ctx, {
    //     type: 'bar',
    //     responsive: true,
    //     legend: {
    //         display: false
    //     },
    //     data: {
    //         labels: ['USA', 'GER', 'AUS', 'UK', 'RO', 'BR'],
    //         datasets: [{
    //             label: "Countries",
    //             fill: true,
    //             backgroundColor: gradientStroke,
    //             hoverBackgroundColor: gradientStroke,
    //             borderColor: '#1f8ef1',
    //             borderWidth: 2,
    //             borderDash: [],
    //             borderDashOffset: 0.0,
    //             data: [53, 20, 10, 80, 100, 45],
    //         }]
    //     },
    //     options: gradientBarChartConfiguration
    // });
});
