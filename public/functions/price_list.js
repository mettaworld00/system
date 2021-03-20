$(document).ready(function(){

    const SITE_URL = "http://localhost/sistem/";
   

}) // Ready




/**
 * Agregar lista de precios
 ----------------------------------*/

 function AddList(user_id){

    var list_name = $('#list_name').val();
    var list_value = $('#list_value').val();
    var list_comment = $('#list_comment').val();

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/price_list.php",
        data: {
            userID: user_id,
            list_name: list_name,
            list_value: list_value,
            list_comment: list_comment,
            action: 'agregarLista'
        },
        beforeSend: function () {
            $('.loader').show();
        },
        success: function (res) {
            
            try {

                if (res != 1) {
                    throw new Error('No se ha podido insertar esta lista');
                }

            } catch (error) {

                console.log(error)
                $('.loader').hide();
            }

            $('.loader').hide();
        }
    });
 }