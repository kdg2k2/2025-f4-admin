$(document).ready(async function () {
    $("#id_document_type").on("change", handleChange);
    $("#form-add-document").on("submit", async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const { data } = await http.post("api/document/store", formData);
        if (data) {
            alertSuccess("Thêm tài liệu thành công!");
            setTimeout(() => {
                window.location.href = "/admin/documents";
            }, 1000);
        }
    });
});

$(".add-cart").on("click", function () {
    const id = $(this).data("id");
    cartModule.add(id);
});
