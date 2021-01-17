$(document).ready(function () {

    const SITE_URL = "http://localhost/sistem/";
    const format = new Intl.NumberFormat('en'); // 0,00

    $('#addService').hide(); // Default
    $('#processService').hide();
    $('#cancelService').hide();

    $('#total_service').val('0.00')
    $('#total_service_discount').val('0.00');
    $('#total_service_subtotal').val('0.00');


    function reload() {
        $('#noService').load(location.href + " #noService");
    }

    /**
     * Generar No. factura
     ------------------------*/

    function clcNoInvoice () {

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/services.php",
            data: {
                action: "generarNoServicio"
            },
            success: function (res) {
                var pref = '00';
                $('#noService').val(pref + res);
            }
        });
    }

    clcNoInvoice();

    /**
     * Buscar datos del servicio
     * ------------------------------------------ */

    $('#service_description').change(function () {

        var service = $(this).val()

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/services.php",
            data: {
                service_id: service,
                action: 'buscarServicio'
            },
            success: function (res) {

                if (res != 'null') {
                    var data = JSON.parse(res);

                    // Habilitar campos

                    $('#addService').show();
                    $('#service_quantity').attr('disabled', false);
                    $('#service_discount').attr('disabled', false);

                    // Mostrar datos

                    $('#service_price').val(format.format(data.price));
                    $('#service_quantity').val(1);
                    $('#totalServicePrice').val(format.format(data.price));
                }

            }
        });
    });


    // Calcular cantidad

    $('#service_quantity').keyup(function (e) {
        e.preventDefault();

        clcService();

    });

    // Calcular Descuento

    $('#service_discount').keyup(function (e) {
        e.preventDefault();

        clcService();

    });


    function clcService() {

        var quantity = $('#service_quantity').val();

        if ($('#service_quantity').val() < 1 || isNaN($('#service_quantity').val())) {

            $('#addService').hide();

        } else {

            $('#addService').show();
            var price = $('#service_price').val().replace(',', '');
            var totalService = parseInt(quantity) * parseInt(price) - $('#service_discount').val();

            $('#totalServicePrice').val(format.format(totalService));
        }

    }




    function clcTotal() {


        if (localStorage.getItem('services')) {

            $('#total_service_subtotal').val('0.00')
            $('#total_service_discount').val('0.00');
            $('#total_service').val('0.00');
            $('#purchase').val('0');

            let subtotal = 0;
            let discount = 0;

            if ($('#rows_services').length >= 1) {

                ArrayServices.forEach((element, index) => {

                    var quantity = parseInt(element.quantity);
                    subtotal += quantity * parseInt(element.price);
                    discount += element.discount;
                    var total = subtotal - discount;

                    $('#total_service_subtotal').val(format.format(subtotal));
                    $('#total_service_discount').val(format.format(discount));
                    $('#total_service').val(format.format(total));
                    $('#purchase').val(total);
                });
            }

        }
    }

    /**
    * Detalles
    -----------------------------------*/

    let ArrayServices = [];

    $('#addService').on('click', (e) => {
        e.preventDefault();

        let data = {

            name: $('#select2-service_description-container').attr('title'),
            service_id: $('#service_description').val(),
            quantity: $('#service_quantity').val(),
            price: $('#service_price').val(),
            discount: $('#service_discount').val(),
            final_price: $('#totalServicePrice').val().replace(',', '')

        }

        FindAMatch(ArrayServices)

        function FindAMatch(arr) {

            if (arr.length < 1) {

                arr.push(data);
                createDB();

            } else {

                let found = arr.find(element => element.name == data.name)

                if (found == undefined) {

                    arr.push(data);
                    createDB();
                }

            }
        }

    })


    function createDB() {

        localStorage.setItem('services', JSON.stringify(ArrayServices));
        showDB(); // Mostrar DB
        clcTotal(); // Calcular total
    }


    let arrayLocalStorage;

    function showDB() {


        // Agregar boton Cancel y Guardar
        if ($('#rows_services').length >= 1) {

            $('#processService').show();
            $('#cancelService').show();

        } else {

            $('#processService').hide();
            $('#cancelService').hide();
        }

        document.querySelector('#rows_services').innerHTML = ""; // Vaciar detalle

        if (localStorage.getItem("services")) {
            arrayLocalStorage = JSON.parse(localStorage.getItem("services"));
        }

        // Loop de los servicios en localStorage 
        arrayLocalStorage.forEach((element, index) => {
            var disc = format.format(element.discount);
            document.querySelector('#rows_services').innerHTML += `<tr><td>${element.name}</td><td>${element.quantity}</td><td>${element.price}</td><td>${disc}</td><td>${format.format(element.final_price)}</td><td><i id="delete" class=" fas fa-backspace"></i></td></tr>`;

        });

        // Mostrar detalle
        var row_length = $('#rows_services tr').length;
        if (row_length >= 1) {
            $('#Detalle_service').show()
        }

    }


    // Auto cargar servicios del LocalStorage

    $(function () {

        // Verificar
        if (localStorage.getItem("services")) {

            arrayLocalStorage = JSON.parse(localStorage.getItem("services"));

            // Loop de los servicios en localStorage 
            arrayLocalStorage.forEach((element, index) => {


                let data = {

                    name: element.name,
                    service_id: element.service_id,
                    quantity: element.quantity,
                    price: element.price,
                    discount: element.discount,
                    final_price: element.final_price

                }

                ArrayServices.push(data); // Guardar de localStorage a ArrayServices
                clcTotal();

                // Mostrar botones Cancel y Guardar

                if ($('#rows_services').length >= 1) {

                    $('#processService').show();
                    $('#cancelService').show();

                } else {

                    $('#processService').hide();
                    $('#cancelService').hide();
                }

                // Filas
                var disc = format.format(element.discount);
                document.querySelector('#rows_services').innerHTML += `<tr><td>${element.name}</td><td>${element.quantity}</td><td>${element.price}</td><td>${disc}</td><td>${format.format(element.final_price)}</td><td><i id="delete" class=" fas fa-backspace"></i></td></tr>`;

            });

        }


    })


    /**
     * Eliminar servicio
     ---------------------------------------------*/

    var services = document.querySelector('#rows_services')

    if (services != null) {

        services.addEventListener('click', (e) => {
            e.preventDefault();

            if (e.path[1].id == "delete") {

                deleteDB(e.path[3].childNodes[0].innerHTML)
                // console.log(e.path[3].childNodes[0].innerHTML)

            } else if (e.path[0].id == "delete") {

                deleteDB(e.path[2].childNodes[0].innerHTML);
                //  console.log(e.path[2].childNodes[0].innerHTML)

            }
        })

    }



    function deleteDB(name) {
        let indexArray;

        // Loop de los services en localStorage 
        arrayLocalStorage.forEach((element, index) => {

            if (element.name == name) {
                indexArray = index;

            }

        });

        ArrayServices.splice(indexArray, 1);
        createDB(ArrayServices)
    }


    /**
     * Factura de servicio
     ------------------------------------------*/

    function unknownCustomer() {

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/contacts.php",
            data: {
                action: 'CrearClienteDesconocido'
            },
            success: function (res) {
                CreateInvoice(res);
            }
        });
    }

    $('#processService').on('click', (e) => {
        e.preventDefault();

        if ($('#rows_services tr').length > 0) {

            if ($('#customer_id').val() < 1) {

                unknownCustomer(); // Crear cliente desconocido

            } else {

                CreateInvoice();

            }

        }
    });

    // Crear factura

    function CreateInvoice(contact_id) {

        // Verificar contact_id

        let customer_id;

        if (contact_id > 0) {
            customer_id = contact_id;
        } else {
            customer_id = $('#customer_id').val();

        }

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/services.php",
            data: {
                action: "procesarVenta",
                customer_id: customer_id,
                user_id: $('#user_id').val(),
                payment_method: $('#payment_method').val(),
                purchase: $('#purchase').val(),
                noinvoice: $('#noService').val(),
                created_at: $('#date').val(),
                expiration: $('#invoice_expiration').val()
            },
            success: function (res) {
                console.log(res);

                 createServiceDetail(res)  // Crear detalle

            }
        });

    };


    // Crear detalle de servicio

    function createServiceDetail(invoice_id) {

        if (localStorage.getItem("services")) {

            arrayL = JSON.parse(localStorage.getItem("services"));

            arrayL.forEach((element, index) => {

                $.ajax({
                    type: "post",
                    url: SITE_URL + "functions/services.php",
                    data: {
                        action: "crearDetalle",
                        user_id: $('#user_id').val(),
                        serviceID: element.service_id,
                        noinvoice: invoice_id,
                        total_quantity: element.quantity,
                        total_price: element.final_price,
                        discount: element.discount,
                        created_at: $('#date').val()
                    },
                    success: function (res) {
                          
                        if (res == 'listo') {

                            localStorage.clear();
                            window.location.reload();

                            clcNoInvoice(); // Generar número de la nueva factura

                        } else {
                            console.log(res)
                        }
                      
                    }
                });

            }); // Loop
        }

    }







}) // Ready ----------------------------//



/**
 * Crear servicio
 ---------------------------------------------*/

function AddService() {


    $.ajax({
        type: "post",
        url: SITE_URL + "functions/services.php",
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