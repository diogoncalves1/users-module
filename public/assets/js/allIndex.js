function modalDelete(id) {
    modalAlert("Tem a certeza que quer apagar?", tryDelete, id);
}

function tryDelete(url) {
    $.ajax({
        url: url,
        type: "DELETE",
        success: function (response) {
            console.log(response);
            successToast(response.message);
            $("#data-table").DataTable().ajax.reload();
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
