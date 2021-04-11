$(document).ready(function () {

    const SITE_URL = "http://localhost/sistem/";

    $('#createNewCategorie').on('click', (e) => {
        e.preventDefault();

        var data = $('#formAddCategories').serialize();

        addNewCategorie(data);
    })

    function addNewCategorie(data) {

        $.ajax({
            type: "post",
            url: "http://localhost/sistem/categories/save",
            data: data,
            success: function (response) {
                $('input[type="text"]').val('');
                $('input[type="number"]').val('');
                $('.table').load(location.href + " .table");
            }
        });
    }




}); // Ready



/**
 * Agregar categoría
 ------------------------------------*/

function AddCategorie(user_id) {

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/categories.php",
        data: {
            userID: user_id,
            name: $('#category_name').val(),
            comment: $('#category_comment').val(),
            action: 'agregarCategoria'
        },
        beforeSend: function () {
            $('.loader').show();
        },
        success: function (res) {

            if (res == "ready") {

                $(".table").load(location.href + " .table");

            } else {
                alertify.alert("<div class='error-info'><i class='text-danger fas fa-exclamation-circle'></i>" + " " + res + "</div>").set('basic', true);
            }
            $(".loader").hide();
        }
    });

}

/**
 * Actualizar categoría
 */

 function UpdateCategorie(category_id) {

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/categories.php",
        data: {
            category_id: category_id,
            name: $('#category_name').val(),
            comment: $('#category_comment').val(),
            action: 'actualizar_categoria'
        },
        beforeSend: function () {
            $('.loader').show();
        },
        success: function (res) {

            if (res == "ready") {

                $(".table").load(location.href + " .table");

            } else {
                alertify.alert("<div class='error-info'><i class='text-danger fas fa-exclamation-circle'></i>" + " " + res + "</div>").set('basic', true);
            }
            $(".loader").hide();
        }
    });

}

/**
 * Eliminar categoria
 ----------------------------------*/

function deleteCategory(id) {

    alertify.confirm(
        "¿Estas seguro que deseas borrar esta categoría? ",
        function () {

            $.ajax({
                type: "post",
                url: SITE_URL + "functions/categories.php",
                data: {
                    category_id: id,
                    action: 'eliminar_categoria'
                },
                beforeSend: function () {
                    $(".loader").show();
                },
                success: function (res) {
                    
                    if (res == "ready") {

                        $(".table").load(location.href + " .table");

                    } else {
                        alertify.alert("<div class='error-info'><i class='text-danger fas fa-exclamation-circle'></i>" + " " + res + "</div>").set('basic', true);
                    }
                    $(".loader").hide();

                }
            });

        }
    );
}