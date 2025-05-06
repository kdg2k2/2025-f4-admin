/**=====================
 Custom Dropzone  Start
 ==========================**/
var DropzoneExample = (function () {
    var DropzoneDemos = function () {
        Dropzone.options.singleFileUpload = {
            paramName: "file",
            maxFiles: 1,
            maxFilesize: 5,
            addRemoveLinks: true,
            accept: function (file, done) {
                console.log(file);
                // done();
            },
        };
        Dropzone.options.multiFileUpload = {
            paramName: "file",
            // maxFiles: 10,
            // maxFilesize: 10,
            addRemoveLinks: true,
            acceptedFiles: "image/*,video/mp4, video/quicktime, video/x-flv, application/x-mpegURL, video/3gpp, video/x-msvideo",
            accept: function (file, done) {
                console.log(file);
            },
        };
        Dropzone.options.fileTypeValidation = {
            paramName: "file",
            maxFiles: 10,
            maxFilesize: 10,
            addRemoveLinks: true,
            acceptedFiles: "image/*,video/mp4, video/quicktime, video/x-flv, application/x-mpegURL, video/3gpp, video/x-msvideo",
            accept: function (file, done) {
                console.log(file);
            },
        };
    };

    return {
        init: function () {
            DropzoneDemos();
        },
    };
})();
DropzoneExample.init();

/**=====================
 Custom Dropzone Ends
 ==========================**/
