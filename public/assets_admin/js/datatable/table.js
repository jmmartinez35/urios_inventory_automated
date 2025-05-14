$(document).ready(function () {
    let tableIds = [
        "datatable3",
        "datatable2",
        "datatable1",
        "datatable",
        "datatable-pending",
        "datatable-approved",
        "datatable-cancelled",
        "datatable-completed",
    ];

    tableIds.forEach((id) => {
        if ($.fn.DataTable.isDataTable(`#${id}`)) {
            $(`#${id}`).DataTable().destroy();
        }

        if (document.getElementById(id)) {
            $(`#${id}`).DataTable({
                dom: "l<br>Bfrtip",
                buttons: [
                    {
                        extend: "print",
                        text: "Print",
                        autoPrint: true,
                        exportOptions: {
                            columns: ":visible",
                            rows: function (idx, data, node) {
                                var dt = new $.fn.dataTable.Api("#example");
                                var selected = dt
                                    .rows({ selected: true })
                                    .indexes()
                                    .toArray();
                                if (
                                    selected.length === 0 ||
                                    $.inArray(idx, selected) !== -1
                                ) {
                                    return true;
                                } else {
                                    return false;
                                }
                            },
                        },

                        customize: function (win) {
                            $(win.document.body)
                                .find("table")
                                .addClass("display")
                                .css("font-size", "9px");
                            $(win.document.body)
                                .find("tr:nth-child(odd) td")
                                .each(function (index) {
                                    $(this).css("background-color", "#D0D0D0");
                                });
                            $(win.document.body)
                                .find("h1")
                                .css("text-align", "center");
                        },
                    },

                    "excel",
                    "pdf",
                    "colvis",
                ],

                responsive: {
                    details: true,
                    breakpoints: [
                        { name: "desktop", width: Infinity },
                        { name: "tablet", width: 1024 },
                        { name: "fablet", width: 768 },
                        { name: "phone", width: 480 },
                    ],
                },
                language: {
                    paginate: {
                        first: "First",
                        previous: "Previous",
                        next: "Next",
                        last: "Last",
                    },
                },
                select: true,
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 100],
                columnDefs: [{ orderable: false, targets: "_all" }],
            });
        }
    });

    var table = $("#datatable-def").DataTable({
        dom: "l<br>Bfrtip",
        buttons: [
            {
                extend: "print",
                text: "Print",
                autoPrint: true,
                exportOptions: {
                    columns: ":visible",
                    rows: function (idx, data, node) {
                        var dt = new $.fn.dataTable.Api("#example");
                        var selected = dt
                            .rows({ selected: true })
                            .indexes()
                            .toArray();
                        if (
                            selected.length === 0 ||
                            $.inArray(idx, selected) !== -1
                        ) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                },

                customize: function (win) {
                    $(win.document.body)
                        .find("table")
                        .addClass("display")
                        .css("font-size", "9px");
                    $(win.document.body)
                        .find("tr:nth-child(odd) td")
                        .each(function (index) {
                            $(this).css("background-color", "#D0D0D0");
                        });
                    $(win.document.body).find("h1").css("text-align", "center");
                },
            },

            "excel",
            "pdf",
            "colvis",
        ],

        language: {
            paginate: {
                first: "First",
                previous: "Previous",
                next: "Next",
                last: "Last",
            },
        },
        select: true,
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],
        columnDefs: [{ orderable: false, targets: "_all" }],
    });

    $("#datatable-def tfoot th").each(function (i) {
        if ($(this).text() !== "") {
            var isStatusColumn = $(this).text() == "Status" ? true : false;
            var select = $('<select><option value=""></option></select>')
                .appendTo($(this).empty())
                .on("change", function () {
                    var val = $(this).val();

                    table
                        .column(i)
                        .search(
                            val ? "^" + $(this).val() + "$" : val,
                            true,
                            false
                        )
                        .draw();
                });

            if (isStatusColumn) {
                var statusItems = [];

                table
                    .column(i)
                    .nodes()
                    .to$()
                    .each(function (d, j) {
                        var thisStatus = $(j).attr("data-filter");
                        if ($.inArray(thisStatus, statusItems) === -1)
                            statusItems.push(thisStatus);
                    });

                statusItems.sort();

                $.each(statusItems, function (i, item) {
                    select.append(
                        '<option value="' + item + '">' + item + "</option>"
                    );
                });
            } else {
                table
                    .column(i)
                    .data()
                    .unique()
                    .sort()
                    .each(function (d, j) {
                        select.append(
                            '<option value="' + d + '">' + d + "</option>"
                        );
                    });
            }
        }
    });

    let tableIDReport = [
        "datatable_report",
        "datatable_report1",
        "datatable_report2",
        "datatable_report3",
    ];

    tableIDReport.forEach(function (id) {
        var table = $("#" + id).DataTable({
            dom: "Bfrtip",
            buttons: [
                {
                    extend: "print",
                    text: "Print",
                    title: "MCES BORROWING REPORT",
                    exportOptions: { columns: ":not(.exclude-print)" },
                },
            ],
            searching: true,
            lengthChange: true,
            info: false,
            pageLength: 5,
            lengthMenu: [5, 10, 25, 50, 100],
            responsive: {
                details: true,
                breakpoints: [
                    { name: "desktop", width: Infinity },
                    { name: "tablet", width: 1024 },
                    { name: "fablet", width: 768 },
                    { name: "phone", width: 480 },
                ],
            },
        });

        if (id === "datatable_report") {
            var monthFilter = $("#month");
            var weekFilter = $("#week-filter");
            var userTypeFilter = $("#usertype-filter");

            $.fn.dataTable.ext.search.push(function (
                settings,
                data,
                dataIndex
            ) {
                if (settings.nTable.id !== 'datatable_report') {
                    return true;
                }

                var monthFilterValue = monthFilter.val().toLowerCase();
                var weekFilterValue = weekFilter.val();
                var userTypeFilterValue = userTypeFilter.val().toLowerCase();

                var rowData = table.row(dataIndex).data();
                if (!rowData) return true;
                
                var rowType = rowData[5]?.toLowerCase();
                var rowDate = new Date(rowData[3]);
                var rowMonth = convertDateToMonthName(rowDate).toLowerCase();
                var rowWeek = getWeekNumber(rowDate);

                if (
                    userTypeFilterValue !== "all" &&
                    !rowType.includes(userTypeFilterValue)
                ) {
                    return false;
                }

                if (
                    monthFilterValue !== "all" &&
                    rowMonth !== monthFilterValue
                ) {
                    return false;
                }

                if (
                    weekFilterValue !== "all" &&
                    rowWeek !== parseInt(weekFilterValue)
                ) {
                    return false;
                }

                return true;
            });

            monthFilter.on("change", function () {
                table.draw();
            });
            weekFilter.on("change", function () {
                table.draw();
            });
            userTypeFilter.on("change", function () {
                table.draw();
            });

            table.draw();
        }

        if (id === "datatable_report1") {
            
            var monthFilter = $("#dmonth1");
            var weekFilter = $("#week1filter");
            var userTypeFilter = $("#usertype1-filter");

            $.fn.dataTable.ext.search.push(function (
                settings,
                data,
                dataIndex
            ) {
                if (settings.nTable.id !== 'datatable_report1') return true;

                var monthFilterValue = monthFilter.val().toLowerCase();
                var weekFilterValue = weekFilter.val();
                var userTypeFilterValue = userTypeFilter.val().toLowerCase();

                var rowData = table.row(dataIndex).data();
                if (!rowData) return true;
                
               
                var rowType = rowData[4]?.toLowerCase();
                var rowDate = new Date(rowData[6]);
                
                var rowMonth = convertDateToMonthName(rowDate).toLowerCase();
                var rowWeek = getWeekNumber(rowDate);
               
                if (
                    userTypeFilterValue !== "all" &&
                    !rowType.includes(userTypeFilterValue)
                ) {
                    return false;
                }

                if (
                    monthFilterValue !== "all" &&
                    rowMonth !== monthFilterValue
                ) {
                    return false;
                }

                if (
                    weekFilterValue !== "all" &&
                    rowWeek !== parseInt(weekFilterValue)
                ) {
                    return false;
                }

                return true;
            });

            monthFilter.on("change", function () {
                table.draw();
            });
            weekFilter.on("change", function () {
                table.draw();
            });
            userTypeFilter.on("change", function () {
                table.draw();
            });

            table.draw();
        }

        function convertDateToMonthName(date) {
            return date.toLocaleString("en-US", { month: "long" });
        }

        function getWeekNumber(date) {
            var firstDayOfMonth = new Date(
                date.getFullYear(),
                date.getMonth(),
                1
            );
            var dayOfWeek = firstDayOfMonth.getDay();
            var weekNumber = Math.ceil((date.getDate() + dayOfWeek) / 7);
            return weekNumber;
        }
    });
});
