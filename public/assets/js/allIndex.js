function modalDelete(id) {
    modalAlert("Tem a certeza que quer apagar?", tryDelete, id);
}

function tryDelete(id) {
    var url = window.location.pathname + "/" + id;

    $.ajax({
        url: url,
        type: "DELETE",
        success: function (response) {
            console.log(response);
            successToast(response.message);
            $("#table").DataTable().ajax.reload();
        },
        error: function (error) {
            if (error.status == 403) {
                console.log(error.responseJSON);
                warningToast(error.responseJSON.message);
            } else {
                if (error.responseJSON.message)
                    return errorToast(error.responseJSON.message);
                errorToast("Erro na tentativa.");
            }
        },
    });
}
