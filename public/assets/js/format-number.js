const formatNumber = (value) => {
    if (!$.isNumeric(value)) return value; // Kiểm tra nếu không phải số thì trả về nguyên bản

    return parseFloat(value).toLocaleString("de-DE", {
        minimumFractionDigits: 0,
        maximumFractionDigits: 2,
    });
};