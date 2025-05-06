const showRequiredMark = () => {
    $("input[required], select[required], textarea[required]").each(
        function () {
            const elm = $(this);
            var label = elm.siblings("label");
            if (label.length == 0) label = elm.parent().find("lable");
            var labelText = label.text() + '<span style="color:red"> *</span>';
            label.html(labelText);
        }
    );
};
