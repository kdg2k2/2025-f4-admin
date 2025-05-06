const destroySumoSelect = (selector) => {
    selector.each(function () {
        if ($(this)[0].sumo) {
            $(this)[0].sumo.unload();
        }
    });
};
const initSumoSelect = (selector, placeholder = "Chọn...") => {
    selector.SumoSelect({
        okCancelInMulti: false,
        csvDispCount: 1,
        selectAll: true,
        search: true,
        searchText: "Nhập tìm kiếm...",
        placeholder: placeholder,
        captionFormat: "Đã chọn {0} lựa chọn",
        captionFormatAllSelected: "Đã chọn tất cả {0} lựa chọn",
        captionFormatAllSelected: "Tất cả",
        locale: ["Xác nhận", "Hủy", "Chọn tất cả"],
    });
};
const $selects = $("select");
const refreshSumoSelect = (selects = null) => {
    if (selects) {
        destroySumoSelect(selects);
        initSumoSelect(selects);
    }
    destroySumoSelect($selects);
    initSumoSelect($selects);
};
