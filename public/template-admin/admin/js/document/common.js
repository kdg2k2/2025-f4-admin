const reset = () => $("#other").empty();
const getLegalTypes = () => {
    return http.get("/api/document/type/legal/list", { paginate: 0 });
};
const getScientificPublicationTypes = () => {
    return http.get("/api/document/type/scientific_publication/list", {
        paginate: 0,
    });
};
const getBiodiversityTypes = () => {
    return http.get("/api/document/type/biodiversity/list", { paginate: 0 });
};

const listerNewDocumentLegal = () => {
    $("select[name='new_document_legal[id_type]']").on(
        "change",
        async function () {
            const value = $(this).val();
            if (value == "1") {
                $("#other").append(/*html */`
                    <div class="col-md-6 mb-3 other">
                        <label for="name" class="form-label">Loại tài liệu khác: <span style="color:red"> *</span></label>
                        <input required type="text" class="form-control" name="new_document_legal_type[name]" placeholder="Nhập loại tài liệu khác">
                    </div>
                `);
            } else {
                $("#other").find(".other").remove();
            }
        }
    );
};

const listerNewDocumentScientificPublication = () => {
    $("select[name='new_document_scientific_publication[id_type]']").on(
        "change",
        async function () {
            const value = $(this).val();
            if (value == "1") {
                $("#other").append(/*html */`
                    <div class="col-md-6 mb-3 other">
                        <label for="name" class="form-label">Loại tài liệu khác: <span style="color:red"> *</span></label>
                        <input required type="text" class="form-control" name="new_document_scientific_publication_type[name]" placeholder="Nhập loại tài liệu khác">
                    </div>
                `);
            } else {
                $("#other").find(".other").remove();
            }
        }
    );
};

const listerNewDocumentBiodiversity = () => {
    $("select[name='new_document_biodiversitie[id_type]']").on(
        "change",
        async function () {
            const value = $(this).val();
            if (value == "1") {
                $("#other").append(/*html */`
                    <div class="col-md-6 mb-3 other">
                        <label for="name" class="form-label">Loại tài liệu khác: <span style="color:red"> *</span></label>
                        <input required type="text" class="form-control" name="new_document_biodiversitie_type[name]" placeholder="Nhập loại tài liệu khác">
                    </div>
                `);
            } else {
                $("#other").find(".other").remove();
            }
        }
    );
};

const handleChange = async (select = {}) => {
    const value = $("#id_document_type").val();
    const bodyForm = $("#other");
    reset();
    // value of case file config\documents.php
    switch (value) {
        case "1":
            bodyForm.append(/*html */ `
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Loại tài liệu pháp lý khác: <span style="color:red"> *</span></label>
                    <input required type="text" class="form-control" name="new_document_type[name]" placeholder="Nhập loại tài liệu pháp lý khác">
                </div>
            `);
            break;
        case "2":
            const { data } = await getLegalTypes();
            bodyForm.append(/*html */ `
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Số hiệu văn bản:<span style="color:red"> *</span></label>
                    <input value="${select?.docNumber}" required type="text" class="form-control" name="new_document_legal[doc_number]" placeholder="Nhập số hiệu văn bản">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Hiệu lực:<span style="color:red"> *</span></label>
                    <select required class="form-select" name="new_document_legal[validity]">
                        <option ${select?.validity == 'active' ? 'selected' : ''} value="active">Có hiệu lực</option>
                        <option ${select?.validity == 'expired' ? 'selected' : ''} value="expired">Hết hiệu lực</option>
                        <option ${select?.validity == 'upcoming' ? 'selected' : ''} value="upcoming">Sắp hết hiệu lực</option>
                        <option ${select?.validity == 'undefined' ? 'selected' : ''} value="undefined">Chưa xác định</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Loại tài liệu pháp lý:<span style="color:red"> *</span></label>
                    <select required class="form-select" name="new_document_legal[id_type]">
                        ${data
                            .map(
                                (item) =>
                                    `<option ${select?.legalId == item.id ? 'selected' : ''} value="${item.id}">${item.name}</option>`
                            )
                            .join("")}
                    </select>
                </div>
            `);
            listerNewDocumentLegal();
            break;

        case "3": {
            const { data } = await getScientificPublicationTypes();
            bodyForm.append(/*html*/`
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Năm ấn phẩm: <span style="color:red"> *</span></label>
                    <input value="${select?.year}" required type="number" class="form-control" name="new_document_scientific_publication[year]" placeholder="Nhập năm ấn phẩm">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Loại ấn phẩm khoa học: <span style="color:red"> *</span></label>
                    <select required class="form-select" name="new_document_scientific_publication[id_type]">
                        ${data
                            .map(
                                (item) =>
                                    `<option ${item.id == select?.scientificPublicationId ? 'selected' : ''} value="${item.id}">${item.name}</option>`
                            )
                            .join("")}
                    </select>
                </div>
            `);
            listerNewDocumentScientificPublication();
            break;
        }
        case "4": {
            const { data } = await getBiodiversityTypes();
            bodyForm.append(/*html*/ `
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Loại tài liệu đa dạng sinh học: <span style="color:red"> *</span></label>
                    <select required class="form-select" name="new_document_biodiversitie[id_type]">
                        ${data
                            .map(
                                (item) =>
                                    `<option ${select?.biodiversitieId == item.id ? 'selected' : ''} value="${item.id}">${item.name}</option>`
                            )
                            .join("")}
                    </select>
                </div>
            `);
            listerNewDocumentBiodiversity();
            break;
        }
    }
};
