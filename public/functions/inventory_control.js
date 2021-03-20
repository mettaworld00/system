$(document).ready(function () {

    const SITE_URL = "http://localhost/sistem/";

    /**
     * Buscar producto
    -------------------------------------------- */
    $('#addRow').hide();
    $('#addSetting').hide();
    $('#cancelSetting').hide();

    $('#quantity_setting').attr('disabled', true);
    $('#price_in_setting').attr('disabled', true);

    $('#description_setting').change(function () {
        var product_name = $('#select2-description_setting-container').attr('title');

        if (product_name != '') {
            searchProduct(product_name)
        } else {
            searchProduct(product_name)
        }
    });

    function searchProduct(product_name) {

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/inventory_control.php",
            data: {
                query: product_name,
                action: 'mostrarProductos'
            },
            success: function (res) {

                $('#addRow').hide();

                var data = JSON.parse(res);
                const format = new Intl.NumberFormat('en');

                $('#final_quantity_setting').val("");
                $('#total_setting').val("");


                $('#quantity_setting').attr('disabled', false);
                $('#price_in_setting').attr('disabled', false);

                $('#current_quantity_setting').val(data.quantity);
                $('#price_in_setting').val(data.price_in);
                $('#quantity_setting').val(0);

            }
        });
    }

    /**
     * Calcular cantidad final
     */

    $('#quantity_setting').keyup(function () {

        var quantity_setting = $(this).val();

        if (quantity_setting != '') {
            finalQuantity(quantity_setting)
        } else {
            finalQuantity(quantity_setting)

        }

    })

    $('#type_setting').change(() => {

        var quantity = $('#quantity_setting').val();
        finalQuantity(quantity);
    })

    function finalQuantity(quantity_setting) {

        // Activar boton Agregar
        if (quantity_setting >= 1) {
            $('#addRow').show();
        } else {
            $('#addRow').hide();
        }

        var quantity = $('#current_quantity_setting').val();
        var type_setting = $('#select2-type_setting-container').attr('title');

        if (type_setting == 'incremento') {

            var finalQuantity = parseInt(quantity) + parseInt(quantity_setting);
            $('#final_quantity_setting').val(finalQuantity);

        } else if (type_setting == 'descremento') {

            var finalQuantity = parseInt(quantity) - parseInt(quantity_setting);
            $('#final_quantity_setting').val(finalQuantity);
        }
        totalSetting();
    }

    /**
     * Calcular total ajustado
     ------------------------------------------*/

    $('#price_in_setting').keyup(function () {

        totalSetting();
    })

    function totalSetting() {

        const format = new Intl.NumberFormat('en');
        var price_out_setting = $('#price_in_setting').val();

        var quantity_setting = $('#quantity_setting').val();
        var total = quantity_setting * price_out_setting;
        $('#total_setting').val(format.format(total));

    }

    $('#total_setting_price').val('0.00')

    function clcTotal() {

        if (localStorage.getItem('settings')) {

            $('#total_setting_price').val('0.00');
            $('#total_setting_hidden').val();
            $('#total_quantity_hidden').val();

            const format = new Intl.NumberFormat('en-CA', {
                style: 'currency',
                currency: 'DOP'
            });

            let total_setting = 0;
            let total_quantity = 0;

            ArraySettings.forEach((element, index) => {

                total_setting += parseInt(element.total_setting);
                total_quantity += parseInt(element.quantity);

                $('#total_setting_hidden').val(total_setting);
                $('#total_quantity_hidden').val(total_quantity);
                $('#total_setting_price').val(format.format(total_setting));

            });


        }
    }

    /**
     * Detalles
     -----------------------------------*/

    var row_length = $('#rows_settings tr').length;
    if (row_length < 1) {
        $('#Detalle_setting').hide()
    }

    let ArraySettings = [];

    $('#addRow').on('click', (e) => {
        e.preventDefault();

        let data = {

            product_name: $('#select2-description_setting-container').attr('title'),
            product_id: $('#description_setting').val(),
            current_quantity: $('#current_quantity_setting').val(),
            quantity: $('#quantity_setting').val(),
            final_quantity: $('#final_quantity_setting').val(),
            price_in: $('#price_in_setting').val(),
            total_setting: $('#total_setting').val().replace(/,/g, ""),
            type_name: $('#select2-type_setting-container').attr('title'),
            type_id: $('#type_setting').val()

        }

        // Buscar coincidencia si existe en el localStorage
        FindAMatch(ArraySettings)

        function FindAMatch(arr) {

            if (arr.length < 1) {

                arr.push(data);
                createDB();

            } else {

                let found = arr.find(element => element.product_name == data.product_name)

                if (found == undefined) {

                    arr.push(data);
                    createDB();
                }

            }
        }

    });

    function createDB() {

        // Limpiar formulario de entrada
        $('#select2-description_setting-container').empty();
        $('#current_quantity_setting').val('');
        $('#quantity_setting').val('');
        $('#price_in_setting').val('');
        $('#final_quantity_setting').val('');
        $('#total_setting').val('');
        $('#quantity_setting').attr('disabled', true);
        $('#price_in_setting').attr('disabled', true);
        $('#addRow').hide();


        localStorage.setItem("settings", JSON.stringify(ArraySettings));
        showDB(); // Mostrar DB
        clcTotal(); // Calcular total

    }

    let arrayLocalStorage;

    function showDB() {

        //  Agregar boton Cancel y Guardar
        if ($('#rows_settings').length >= 1) {

            $('#addSetting').show();
            $('#cancelSetting').show();

        } else {

            $('#addSetting').hide();
            $('#cancelSetting').hide();
        }

        const format = new Intl.NumberFormat('en'); // 0,00

        document.querySelector('#rows_settings').innerHTML = ""; // Vaciar detalle

        if (localStorage.getItem("settings")) {
            arrayLocalStorage = JSON.parse(localStorage.getItem("settings"));
        }

        // Loop de los ajustes en localStorage 
        arrayLocalStorage.forEach((element, index) => {
            var totalSetting = element.quantity * element.price_in;

            document.querySelector('#rows_settings').innerHTML += `<tr><td>${element.product_name}</td><td>${element.current_quantity}</td><td>${element.type_name}</td><td>${element.quantity}</td><td>${element.final_quantity}</td><td>${format.format(totalSetting)}</td><td><i id="delete" class="text-danger fas fa-backspace"></i></td></tr>`;

        });

        // Mostrar detalle
        var row_length = $('#rows_settings tr').length;
        if (row_length >= 1) {
            $('#Detalle_setting').show()
        }

    }


    /**
 * Borrar Ajuste
 ---------------------------------------------*/

    var setting = document.querySelector('#rows_settings')

    if (setting != null) {

        setting.addEventListener('click', (e) => {
            e.preventDefault();


            if (e.path[1].id == "delete") {

                deleteDB(e.path[3].childNodes[0].innerHTML)

            } else if (e.path[0].id == "delete") {

                deleteDB(e.path[2].childNodes[0].innerHTML);

            }

            function deleteDB(name) {
                let indexArray;

                // Loop de los ajustes en localStorage 
                arrayLocalStorage.forEach((element, index) => {

                    if (element.product_name == name) {
                        indexArray = index;

                    }

                });

                ArraySettings.splice(indexArray, 1);
                createDB()
                clcTotal();

            }
        })

    }











}) // Ready


/**
     * Crear Ajuste de inventario
     ------------------------------------------*/

function addSettings(user_id, warehouse_id) {


    if (localStorage.getItem('settings') != null) {

        arr = JSON.parse(localStorage.getItem('settings'));

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/inventory_control.php",
            data: {
                userID: user_id,
                warehouse_id: warehouse_id,
                total_setting: $('#total_setting_hidden').val(),
                observation: $('#observation_setting').val(),
                action: 'crearAjuste'
            },
            success: function (res) {

                try {

                    if (res > 0) {
                        createDetail(res, arr);
                    } else {
                        throw new Error('No se pudo crear el ajuste ' + res);
                    }

                } catch (error) {

                    console.log(error);
                }

            }
        });

    } else {
        console.log('Error: No se han encontrado valores');
    }

    function createDetail(id, arr) {

        arr.forEach((element, index) => {

            $.ajax({
                type: "post",
                url: SITE_URL + "functions/inventory_control.php",
                data: {
                    product_id: element.product_id,
                    quantity: element.quantity,
                    final_quantity: element.final_quantity,
                    type_id: element.type_id,
                    price_in: element.price_in,
                    item_setting_id: id,
                    type_name: element.type_name,
                    action: 'agregarDetalleAlAjustes'

                },
                success: function (res) {
                    console.log(res)
                }
            });

        });

    }

}

/**
 * Eliminar Ajuste
 -------------------------------------*/

function deleteSetting(item_setting_id) {

    alertify.confirm("<i class='text-warning fas fa-exclamation-circle'></i> Eliminar ajuste", "¿Está seguro de que desea eliminar este ajuste de inventario? Esta operación no se puede deshacer. ",
        function () {

            $.ajax({
                type: "post",
                url: SITE_URL + "functions/inventory_control.php",
                data: {
                    item_setting_id: item_setting_id,
                    action: 'EliminardetalleDelAjuste'
                },
                beforeSend: function () {
                    $('.loader').show();
                },
                success: function (res) {

                    try {

                        EraserSetting(item_setting_id);

                    } catch (error) {

                        console.log(error);
                        $('.loader').hide();
                    }

                }
            });

            function EraserSetting(item_setting_id) {

                $.ajax({
                    type: "post",
                    url: SITE_URL + "functions/inventory_control.php",
                    data: {
                        item_setting_id: item_setting_id,
                        action: 'EliminarAjuste'
                    },
                    success: function (res) {

                        try {

                            if (res == 1) {

                                $('.loader').hide();
                                $('#example').load(location.href + " #example");

                            } else {
                                throw new Error('No se ha podido eliminar este ajuste')
                            }

                        } catch (error) {

                            $('.loader').hide();
                            console.log(error);

                        }

                    }
                });
            }

        },
        function () {

        });

}