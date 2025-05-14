<div class=" m-3">
    <div class="row">
        <div class="col-auto row">
            <div class="col-auto">
                <label class="form-control-plaintext">FILTER BY MONTH:</label>
            </div>
            <div class="col-auto">
                <div class="input-group input-group-sm p-1">
                    <select id="month" wire:model.lazy="selectedMonth" class="form-select w-auto d-inline-block">
                        <option value="">All Months</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div id="frequent-items-chart" wire:ignore></div>

    <script>
        let chartInstance;

        const monthNames = [
            'All Months', 'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];


        const renderChart = (itemNames, borrowCounts, selectedMonth) => {
            if (chartInstance) {
                chartInstance.destroy();
            }

            const monthTitle = selectedMonth ? ` in ${monthNames[selectedMonth]}` : "";


            chartInstance = Highcharts.chart('frequent-items-chart', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: `Most Frequently Borrowed Items${monthTitle}`
                },
                xAxis: {
                    categories: itemNames,
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
                    data: borrowCounts
                }]
            });
        };


        document.addEventListener('DOMContentLoaded', function() {
            // Initial render using data from backend (Blade variables)
            renderChart(@json($itemNames), @json($borrowCounts));

            // Listen for browser event dispatched from PHP
            window.addEventListener('renderChart', function(event) {
                const data = event.detail;
                renderChart(data[0].itemNames, data[0].borrowCounts, data[0].selectedMonth);
            });
        });
    </script>
</div>
