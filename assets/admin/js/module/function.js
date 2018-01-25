$(document).ready(function () {
    $(".integer").keydown(function (e) {
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode == 67 && e.ctrlKey === true) ||
                (e.keyCode == 88 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)) {
            return;
        }
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('.dataTables-example').DataTable({
        pageLength: 100,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy'},
            {extend: 'csv'},
            {extend: 'excel', title: 'ExampleFile'},
            {extend: 'pdf', title: 'ExampleFile'},
            {extend: 'print',
                customize: function (win) {
                    $(win.document.body).addClass('white-bg');
                    $(win.document.body).css('font-size', '10px');

                    $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                }
            }
        ]

    });
    $('.dataTables-button').DataTable({
        paging: false,
        //pageLength: 25,
        responsive: true,
        searching: false
    });
});
function ChangeStatus(value, title, del_entity) {
    var id = $(value).attr("data-id");
    var status = $(value).attr("data-status");
    var old_status = $(value).attr("data-old_status");
    var LID = $(value).attr("data-LID");
    $("#status_value").val(status);
    $("#old_status").val(old_status);
    $("#user_id").val(id);
    $("#LoginID").val(LID);
    $("#statusChange").find(".modal-title").html(title);
    $("#statusChange").find(".modal-body").children("p").html("Do you really want to " + title + "?");
}
function DeleteRecord(value) {
    var id = $(value).attr("data-id");
    $("#record_id").val(id);
    $("#delete-record").find(".modal-body").children("p").html("Do you really want to Delete?");
}