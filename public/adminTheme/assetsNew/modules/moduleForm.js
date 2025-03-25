$(document).ready(function() {
    $('#module-frm').submit(function() {
        $('#module-frm #submit_btn').attr("disabled", true);
        if (true) {
            $('#AjaxLoaderDiv').fadeIn('slow');
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: false,
                processData: false,
                enctype: 'multipart/form-data',
                success: function(result) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                    if (result.status == 1) {
                        $.NotificationApp.send("Success!", result.msg, 'top-right', 'rgba(0,0,0,0.2)', 'success');
                        window.location = $('#module-frm').attr("redirect-url");
                    } else {
                        $.NotificationApp.send("Error!", result.msg, 'top-right', 'rgba(0,0,0,0.2)', 'error');
                        $('#module-frm #submit_btn').attr("disabled", false);
                    }
                },
                error: function(error) {
                    $('#AjaxLoaderDiv').fadeOut('slow');
                   console.log(error)
                }
            });
        }
        return false;
    });
});
