<div>
    <div class="card mb-2">
        <div class="card-body p-3">
            <div id="monthly-borrowing-chart" style="height: 400px; margin-bottom: 50px;"></div>

        </div>

    </div>
    <div class="card ">
        <div class="card-body p-3">
            <div id="frequent-items-chart" style="height: 400px;"></div>

        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Monthly Borrowing Chart
            Highcharts.chart('monthly-borrowing-chart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Monthly Borrowing Report'
                },
                xAxis: {
                    categories: @json($months),
                    title: {
                        text: 'Month'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Number of Borrowings'
                    }
                },
                exporting: {
                    enabled: false
                },
                credits: {
                    enabled: false
                },
                navigation: {
                    buttonOptions: {
                        enabled: false
                    }
                },
                series: [{
                    name: 'Borrowings',
                    data: @json($monthlyCounts)
                }]
            });


            // Most Frequently Borrowed Items
            Highcharts.chart('frequent-items-chart', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: "This Month's Top 5 Borrowed Items"
                },
                xAxis: {
                    categories: @json($itemNames),
                    title: {
                        text: 'Item Name'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Times Borrowed'
                    }
                },
                series: [{
                    name: 'Borrowed Count',
                    data: @json($borrowCounts)
                }],
                exporting: {
                    enabled: false
                },
                credits: {
                    enabled: false
                },
                navigation: {
                    buttonOptions: {
                        enabled: false
                    }
                }
            });

        });
    </script>




</div>
