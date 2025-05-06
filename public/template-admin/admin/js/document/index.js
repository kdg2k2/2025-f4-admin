const getDocument = () => {
    return http.get("api/document/list", {
        paginate: 0,
    });
};

$(document).ready(async function () {
    console.log(getDocument());
});
