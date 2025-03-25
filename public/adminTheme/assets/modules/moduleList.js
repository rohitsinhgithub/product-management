$(document).ready(function() {
    $(document).on('click', '.module-action .btn-delete-record', function() {
        $text = 'Are you sure ?';
        if ($(this).attr('title') == "delete user") {
            $text = 'Are you sure you want to delete this user ?';
        }
        if (confirm($text)) {
            $url = $(this).attr('href');
            $('#global_delete_form').attr('action', $url);
            $('#global_delete_form #delete_id').val($(this).data('id'));
            $('#global_delete_form').submit();
        }

        return false;
    });

    $("#search-frm").submit(function() {
        oTableCustom.draw();
        return false;
    });

    //$.fn.dataTableExt.sErrMode = 'throw';

    var oTableCustom = $('#server-side-datatables').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        responsive: true,
        pageLength: 25,
        displayStart: 0,
        ajax: {
            url: MODULE_URL,
            data: function(data) {
                data.search_text = $("#search-frm input[name='search_text']").val();
            }
        },
        "order": [
            [0, "desc"]
        ],
        columns: dataColumns,
        "language": {
            "paginate": {
                "previous": "<i class='ri-arrow-left-s-line'>",
                "next": "<i class='ri-arrow-right-s-line'>"
            }
        },
        "drawCallback": function () {
            $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
        }
    });
});