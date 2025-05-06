const initializeTooltips = () => {
    // Xóa tất cả tooltips và các sự kiện tooltip
    $(".tooltip").remove();
    $("body").off(
        "mouseenter mouseleave",
        '[data-bs-toggle="tooltip"], [data-toggle="tooltip"]'
    );

    // Sử dụng delegated events để quản lý tooltips
    $("body").on(
        "mouseenter",
        '[data-bs-toggle="tooltip"], [data-toggle="tooltip"]',
        function () {
            $(this).tooltip("show");
        }
    );

    $("body").on(
        "mouseleave",
        '[data-bs-toggle="tooltip"], [data-toggle="tooltip"]',
        function () {
            $(this).tooltip("hide");
        }
    );

    // Khởi tạo tooltips
    $('[data-bs-toggle="tooltip"], [data-toggle="tooltip"]').tooltip({
        trigger: "manual",
        container: "body",
    });
};
