$(document).ready(function () {

    const SITE_URL = "http://localhost/sistem/";

    /**
     * Guardar Contacto
     ----------------------------------*/

    $('#addContact').on('click', (e) => {
        e.preventDefault();

        $.ajax({
            type: "post",
            url:  SITE_URL + "functions/contacts.php",
            data: {
                name: $('#nameContact').val(),
                rnc: $('#rncContact').val(),
                tel1: $('#telContact1').val(),
                tel2: $('#telContact2').val(),
                email: $('#emailContact').val(),
                action: 'crearContacto'

            },
            success: function (res) {
                console.log(res)
                $('input[type="text"]').val('');
                $('input[type="number"]').val('');
               // $('.table-custom').load(location.href + " .table-custom");
            }
        });
        
    })

   
    // Eliminar cliente 

    function deleteCustomer(id) {

        alertify.confirm("¿Estas seguro que deseas borrar este cliente? ",
            function () {

                $.ajax({
                    url: "http://localhost/sistem/functions/customers.php",
                    method: "post",
                    data: {
                        customer_id: id
                    },
                    success: function (res) {
                        if (res == 1) {

                            $('.table').load(location.href + " .table");


                            alertify.success('Si');
                        } else {
                            alertify.error('No se ha podido eliminar este cliente');
                        }

                    }
                });

            },
            function () {
                alertify.error('Cancelado');
            });
    }





}); // Ready



/**
 * Crear servicio
 ---------------------------------------------*/

 function AddContact() {


    $.ajax({
        type: "post",
        url: SITE_URL + "functions/contacts.php",
        data: {
            name: $('#name_service_md').val(),
            price: $('#price_service_md').val(),
            action: 'agregarServicio'

        },
        success: function (res) {
            window.location.reload();
        }
    });

}