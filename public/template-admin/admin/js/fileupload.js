(function() {
    'use strict'

    /* filepond */
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginImageExifOrientation,
        FilePondPluginFileValidateSize,
        FilePondPluginFileEncode,
        FilePondPluginImageEdit,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageTransform
    );

    /* multiple upload */
    const MultipleElement = document.querySelector('.multiple-filepond');
    FilePond.create(MultipleElement, {
        labelIdle: `Kéo thả tệp tin hoặc <span class="filepond--label-action">Chọn tệp</span>`,
    });

    /* single upload */
    FilePond.create(
        document.querySelector('.single-fileupload'), {
            labelIdle: `Kéo thả tệp tin hoặc <span class="filepond--label-action">Chọn tệp</span>`,
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleButtonRemoveItemPosition: 'center bottom'
        }
    );

})();
