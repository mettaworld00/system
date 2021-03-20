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
 */

 function AddCategorie(user_id){

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
             
            try {

                if (res != 1){
                 throw new Error('No se ha podido insertar esta categoría');
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
 * Borrar categoria
 ----------------------------------*/

 function deleteCategory(id){

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/categories.php",
        data: {
            id: id,
            action: 'eliminarCategoria'
        },
        success: function (res) {
            console.log(res)
        }
    });
 }