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


    /**
     * Agregar categoria
     ------------------------------------------*/

    $('#addCategory').on('click', (e) => {
        e.preventDefault();
 
        $.ajax({
            type: "post",
            url: SITE_URL + "functions/categories.php",
            data: {
                userID: $('#user_id').val(),
                name: $('#category_name').val(),
                comment: $('#category_comment').val(),
                action: 'agregarCategoria'
            },
            success: function (res) {
                     console.log(res)
            }
        });
    })

}); // Ready



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