$("body").prepend(`
    <div id="loading-icon" style="position: absolute; z-index: 9999; display: grid; justify-content: center; align-content: center; width: 100%; height: 100vh; background-color: #0c0c0c68;" hidden>
        <img src="/assets/icons/Loading.gif" alt="">
    </div>
`);

const showLoading = () => {
    var loadingIcon = document.getElementById("loading-icon");
    loadingIcon.style.height = `${window.innerHeight}px`;
    loadingIcon.hidden = false;
};

const hideLoading = () => {
    var loadingIcon = document.getElementById("loading-icon");
    loadingIcon.hidden = true;
};

const showLoadingEvents = () => {
    $("form").on("submit", function () {
        showLoading();
    });

    $(window).on("error", function () {
        hideLoading();
    });
};
