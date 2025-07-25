$(function () {
    $("#table").DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ordering: true,
        searching: true,
        processing: true,
        serverSide: true,
        columnDefs: [
            {
                orderable: false,
                targets: [3],
            },
        ],
        ajax: {
            url: "/admin/permissions/data",
            type: "GET",
            dataSrc: function (json) {
                console.log(json);
                return json.data;
            },
        },
        columns: [
            {
                data: "code",
            },
            {
                data: "name",
            },
            {
                data: "category",
            },
            {
                data: "actions",
            },
        ],
    });
});
