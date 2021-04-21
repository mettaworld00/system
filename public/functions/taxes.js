$(document).ready(function () {

    const SITE_URL = "http://localhost/sistem/";


}) // Ready


/**
* Agregar impuesto
------------------------------------------*/

function AddTax(user_id) {

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/taxes.php",
        data: {
            userID: user_id,
            name: $('#tax_name').val(),
            comment: $('#tax_comment').val(),
            value: $('#tax_value').val(),
            action: 'agregar_impuesto'
        },
        beforeSend: function () {
            $('.loader').show();
        },
        success: function (res) {

            console.log(res)

            if (res == "ready") {

                $(".table").load(location.href + " .table");

            } else {
                alertify.alert("<div class='error-info'><i class='text-danger fas fa-exclamation-circle'></i>" + " " + res + "</div>").set('basic', true);
            }

            $('.loader').hide();
        }
    });

}

/**
 * Actualizar Impuesto
----------------------------------- */

function UpdateTax(tax_id) {

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/taxes.php",
        data: {
            tax_id: tax_id,
            name: $('#tax_name').val(),
            comment: $('#tax_comment').val(),
            value: $('#tax_value').val(),
            action: 'actualizar_impuesto'
        },
        beforeSend: function () {
            $('.loader').show();
        },
        success: function (res) {

            console.log(res)

            if (res == "ready") {

                $(".table").load(location.href + " .table");

            } else {
                alertify.alert("<div class='error-info'><i class='text-danger fas fa-exclamation-circle'></i>" + " " + res + "</div>").set('basic', true);
            }

            $('.loader').hide();
        }
    });

}

/**
 * Eliminar Impuesto
 ----------------------------------*/

function deleteTax(id) {

    alertify.confirm(
        "¿Estas seguro que deseas borrar este impuesto? ",
        function () {

            $.ajax({
                type: "post",
                url: SITE_URL + "functions/taxes.php",
                data: {
                    tax_id: id,
                    action: 'eliminar_impuesto'
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


