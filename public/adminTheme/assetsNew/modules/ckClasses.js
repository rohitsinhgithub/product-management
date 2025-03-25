document.addEventListener("DOMContentLoaded", function() {
    CKEDITOR.config.toolbar = [
        ['NewPage', 'Styles', 'Bold', 'Italic', 'Underline', 'StrikeThrough', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'NumberedList', 'BulletedList', 'Outdent', 'Indent', '-', 'Undo', 'Redo', '-', '-', '-'],
        ['Cut', 'Copy', 'Paste'],
        ['Find', 'Replace'],
        ['Link', 'Unlink'],
        ['Source', '-', 'Maximize']
    ];
    //
    CKEDITOR.config.height = '350px';
    CKEDITOR.replace('ck-editor-area-en');
    CKEDITOR.replace('ck-editor-area-pt');
    CKEDITOR.replace('ck-editor-area-fr');

    var editorEn = CKEDITOR.instances['ck-editor-area-en'];
    var editorPt = CKEDITOR.instances['ck-editor-area-pt'];
    var editorFr = CKEDITOR.instances['ck-editor-area-fr'];

    // Update textarea value when content changes
    editorEn.on('change', function() {
        document.getElementById('ck-editor-area-en').value = editorEn.getData();
    });
    editorPt.on('change', function() {
        document.getElementById('ck-editor-area-pt').value = editorPt.getData();
    });
    editorFr.on('change', function() {
        document.getElementById('ck-editor-area-fr').value = editorFr.getData();
    });
});
