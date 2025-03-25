!function(e) {
    "use strict";
    function t() {
        this.$body = e("body")
    }
    t.prototype.init = function() {
        Dropzone.autoDiscover = false;
        e('[data-plugin="dropzone"]').each(function() {
            var $dropzone = e(this);
            
            if (!$dropzone.hasClass("dropzone-initialized")) {
                var actionUrl = $dropzone.attr("action");
                var previewsContainer = $dropzone.data("previewsContainer");
                var uploadPreviewTemplate = $dropzone.data("uploadPreviewTemplate");

                var config = {
                    url: actionUrl,
                    previewsContainer: previewsContainer,
                };

                if (uploadPreviewTemplate) {
                    config.previewTemplate = e(uploadPreviewTemplate).html();
                }

                var dropzoneInstance = new Dropzone(this, config);

                dropzoneInstance.on("error", function(file, errorMessage, xhr) {
                   $.toast({
                        text: errorMessage['error'],
                        icon: 'error', // success, error, warning, info
                        position: 'top-right',
                        hideAfter: 3000 // milliseconds
                    });       
                });

                dropzoneInstance.on("complete", function(file) {
                    dropzoneInstance.removeFile(file); 
                });

                dropzoneInstance.on("success", function(file, response) {
                    $.toast({
                        text: response.message,
                        icon: 'success',
                        position: 'top-right',
                        hideAfter: 3000
                    });
                });
        
                dropzoneInstance.on("queuecomplete", function() {
                    refeshImage() 
                });
                $dropzone.addClass("dropzone-initialized");
            }
        });
    };

    e.FileUpload = new t, e.FileUpload.Constructor = t
}(window.jQuery), function() {
    "use strict";
    window.jQuery.FileUpload.init()
}();