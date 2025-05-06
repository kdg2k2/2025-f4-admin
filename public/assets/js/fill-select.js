const fillSelect = (selector, data, key, val, addBlank = true) => {
    var options = "";
    if (addBlank == true) options = '<option value="">[Chọn]</option>';
    $.each(data, (k, v) => {
        options += `<option value="${key ? v[key] : v}">${
            val ? v[val] : v
        }</option>`;
    });
    $(`#${selector}`).html(options);
};