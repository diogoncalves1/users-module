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
                targets: [2, 3],
            },
        ],
        ajax: {
            url: "/admin/users/data",
            type: "GET",
            dataSrc: function (json) {
                console.log(json);
                return json.data;
            },
        },
        columns: [
            {
                data: "name",
            },
            {
                data: "email",
            },
            {
                data: "roles",
                render: function (roles) {
                    return roles.map((role) => {
                        role + " ";
                    });
                },
            },
            {
                data: "actions",
            },
        ],
    });
});
