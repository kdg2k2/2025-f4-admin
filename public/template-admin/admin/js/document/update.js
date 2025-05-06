$(document).ready(async function () {
    handleChange({
        year,
        scientificPublicationId,
        biodiversitieId,
        docNumber,
        validity,
        legalId
    });
    $("#id_document_type").on("change", handleChange);
    $("#form-update-document").on("submit", async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const { data } = await http.patch("api/document/update", formData);
        if (data) {
            alertSuccess("Cập nhật tài liệu thành công!");
            setTimeout(() => {
                window.location.href = "/admin/documents";
            }, 1000);
        }
    });
});
