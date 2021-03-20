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
            action: 'agregarImpuesto'
        },
        beforeSend: function () {
            $('.loader').show();
        },
        success: function (res) {

            try {

                if (res != 1) {
                    throw new Error('No se ha podido insertar este impuesto');
                }

            } catch (error) {

                console.log(error)
                $('.loader').hide();
            }

            $('.loader').hide();
        }
    });

}

/**
 * Eliminar Impuesto
 ----------------------------------*/

function deleteTax(id) {

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/taxes.php",
        data: {
            id: id,
            action: 'eliminarImpuesto'
        },
        success: function (res) {
            console.log(res)
        }
    });
}