const destroyDataTable = (element) => {
    if ($.fn.DataTable.isDataTable(element)) element.DataTable().destroy();
};
const createDataTableServerSide = (
    element,
    apiUrl,
    columns,
    mapFn,
    extraParams = {}
) => {
    const dataTable = element.DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        lengthChange: true,
        autoWidth: false,
        ordering: false,
        searching: false,
        lengthMenu: [
            [10, 50, 100],
            [10, 50, 100],
        ],
        bLengthChange: true,
        language: {
            sLengthMenu: "Hiển thị _MENU_ bản ghi",
            searchPlaceholder: "Nhập từ khóa...",
            info: "Từ _START_ đến _END_ | Tổng số _TOTAL_",
            sInfoEmpty: "Không có dữ liệu",
            sEmptyTable: "Không có dữ liệu",
            sSearch: "Tìm kiếm",
            sZeroRecords: "Không tìm thấy dữ liệu phù hợp",
            sInfoFiltered: "",
            paginate: {
                previous: '<i class="fal fa-angle-left"></i>',
                next: '<i class="fal fa-angle-right"></i>',
            },
        },
        ajax: (data, callback) => {
            const page = Math.floor(data.start / data.length) + 1;
            const perPage = data.length;

            apiRequest("get", apiUrl, {
                ...extraParams,
                page,
                per_page: perPage,
            }).then((res) => {
                const items = res?.data?.data ?? [];
                callback({
                    data: items.map(mapFn),
                    recordsTotal: res.data.total,
                    recordsFiltered: res.data.total,
                });
            });
        },
        columns,
    });
    initializeTooltips();
    return dataTable;
};
