$(document).ready(function () {

    const SITE_URL = "http://localhost/sistem/";



     /**
     * Agregar impuesto
     ------------------------------------------*/

     $('#addTax').on('click', (e) => {
        e.preventDefault();
 
        $.ajax({
            type: "post",
            url: SITE_URL + "functions/taxes.php",
            data: {
                userID: $('#user_id').val(),
                name: $('#tax_name').val(),
                comment: $('#tax_comment').val(),
                value: $('#tax_value').val(),
                action: 'agregarImpuesto'
            },
            success: function (res) {
                     console.log(res)
            }
        });
    })


}) // Ready



/**
 * Eliminar Impuesto
 ----------------------------------*/

 function deleteTax(id){

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