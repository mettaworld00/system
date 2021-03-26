$(document).ready(function () {


    const SITE_URL = "http://localhost/sistem/";
    const format = new Intl.NumberFormat('en-CA', {
        style: 'decimal'

    });

    if ($('#rows tr').length > 0) {
        invoiceTotal()
    } // Calcular detalle temporar
    if ($('#detail_row tr').length > 0) {
        detailTotal()
    } // Calcular detalle

    reload();

    function reload() {

        $('#Detalle').load(location.href + " #Detalle");

        //  Generar No. factura

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/invoices.php",
            data: {
                action: "generarNoFactura"
            },
            success: function (res) {
                var pref = 'ch0';
                $('#nofactura').val(pref + res);

                $('#noFactura').load(location.href + " #noFactura");
                localStorage.setItem('Nofactura', pref + res);
            }
        });
    }


    /**
     * Buscar clientes
     ---------------------------------------*/


    $('#searchCustomer').change(function () {
        var search = $('#select2-searchCustomer-container').attr('title');

        AgregarCliente(search);

    });

    function AgregarCliente(query) {
        $.ajax({
            url: SITE_URL + "functions/contacts.php",
            method: "post",
            data: {
                customer: query,
                action: 'buscarCliente'
            },
            success: function (res) {

                var data = JSON.parse(res);

                $('#customer_id').val(data.customer_id);
                $('#customer').val(data.customer_name);
                $('#telephone1').val(data.telephone1);
                $('#rnc').val(data.rnc);

            }
        });
    }


    /**
     * Buscar producto por nombre
     -----------------------------------------*/

    function SearchItemForName(product_name) {

        $.ajax({
            url: SITE_URL + "functions/invoices.php",
            method: "post",
            data: {
                product_name: product_name,
                action: "buscarItemPorNombre"
            },
            success: function (res) {

                try {

                    var data = JSON.parse(res);

                    $('#product_id').val(data[0].product_id);
                    $('#barcode').val(data[0].product_code);
                    $('#description').val(data[0].product_name);
                    $('#price_out').val(format.format(data[0].price_out));
                    $('#quantity').val('1');
                    $('#stock').val(data[0].quantity);
                    $('#discount').val(0);
                    $('#quantity').removeAttr('disabled');
                    $('#discount').removeAttr('disabled');

                    $('#AgregarItem').show();
                    $('#addPurchase').show();

                    // Verificar si la cantidad es mayor que el stock
                    if (data[0].quantity < 1) {
                        $('#AgregarItem').hide()
                        $('#addPurchase').hide();
                    };

                    // Encontrar Id de productos que coincidan en el detalle
                    findAmatch(data[0].product_id);

                    // Importe con descuento
                    if (data[1].discount_value != null) {

                        $('#discount').val(data[1].discount_value);

                        var discount_price = data[0].price_out - data[1].discount_value;
                        $('#total_price').val(format.format(discount_price));
                    } else {
                        $('#total_price').val(format.format(data[0].price_out));
                    }

                    // Verificar si existe impuesto
                    if (data[1].tax_value != null) {

                        if (data[1].tax_value == 0) {
                            $('#tax_value').val('-')
                        } else {
                            $('#tax_value').val(data[1].tax_value);

                        }

                    } else {
                        $('#tax_value').val('-')
                    }

                } catch (error) {

                    $('#price_out').val('0.00');
                    $('#total_price').val('0.00');
                    $('#stock').val('0');
                    $('#quantity').val('0');
                    $('#tax_value').val('0')
                    $('#discount').val('0');
                    $('#description').val('-');
                    $('#quantity').attr("disabled", true);
                    $('#discount').attr("disabled", true);
                    $('#total_price').attr("disabled", true);
                    $('#select2-description-container').empty();
                }


            }
        });
    }


    $('#description').change(function () {
        var product_name = $('#select2-description-container').attr('title');

        if (product_name != '') {
            SearchItemForName(product_name);
        } else {
            SearchItemForName();
        }
    });


    /**
     * Buscar producto por código
     -------------------------------------*/

    function SearchItemForCode(product_code) {

        $.ajax({
            url: SITE_URL + "functions/invoices.php",
            method: "post",
            data: {
                action: "buscarItem",
                product_code: product_code
            },
            success: function (res) {

                try {
                   
                    var data = JSON.parse(res);

                    const format = new Intl.NumberFormat('en'); // Formato 0,000

                    $('#product_id').val(data[0].product_id);

                    $('#select2-description-container').attr('title', data[0].product_name);
                    $('#select2-description-container').empty(); // Vaciar description
                    $('#select2-description-container').append(data[0].product_name); // agregar a description

                    $('#price_out').val(format.format(data[0].price_out));
                    $('#quantity').val(1);
                    $('#stock').val(data[0].quantity);

                    $('#quantity').removeAttr('disabled');
                    $('#discount').removeAttr('disabled');
                    $('#AgregarItem').show();
                    $('#addPurchase').show();

                    // Verificar si la cantidad es mayor que el stock
                    if (data[0].quantity < 1) {
                        $('#AgregarItem').hide()
                        $('#addPurchase').hide();
                    };

                    // Encontrar Id de productos que coincidan en el detalle
                    findAmatch(data[0].product_id);

                    // Importe con descuento
                    if (data[1] != null) {

                        $('#discount').val(data[1].discount_value);

                        var discount_price = data[0].price_out - data[1].discount_value;
                        $('#total_price').val(format.format(discount_price));
                    } else {
                        $('#total_price').val(format.format(data[0].price_out));
                    }

                    // Verificar si existe impuesto
                    if (data[1].tax_value != null) {

                        if (data[1].tax_value == 0) {
                            $('#tax_value').val('-')
                        } else {
                            $('#tax_value').val(data[1].tax_value);

                        }

                    } else {
                        $('#tax_value').val('-')
                    }
                    
                } catch (error) {

                    $('#price_out').val('0.00');
                    $('#total_price').val('0.00');
                    $('#stock').val('0');
                    $('#quantity').val('0');
                    $('#discount').val('0');
                    $('#description').val('-');
                    $('#quantity').attr("disabled", true);
                    $('#discount').attr("disabled", true);
                    $('#total_price').attr("disabled", true);
                    $('#select2-description-container').empty();
                }

            }
        });
    }


    $('#barcode').keyup(function () {
        var product_code = $(this).val();

        if (product_code != '') {
            SearchItemForCode(product_code);
        } else {
            SearchItemForCode();

        }
    });


    /**
     * 
     * Verificar si existe un mismo Id de productos que coincidan en el detalle
    -------------------------------------------- */

    function findAmatch(id) {


        $.ajax({
            type: "post",
            url: SITE_URL + "functions/invoices.php",
            data: {
                action: "buscarCoincidencia",
                product_id: id,
                userID: $('#user_id').val(),
                invoice_id: $('#invoice_id').val()
            },
            success: function (res) {
                if (res != '') {

                    console.log(res);

                    if (res == $('#product_id').val()) {

                        $('#quantity').attr("disabled", true);
                        $('#discount').attr("disabled", true);
                        $('#AgregarItem').hide();
                        $('#addPurchase').hide();

                    } else {

                        $('#AgregarItem').show();
                        $('#addPurchase').show();
                    }
                }
            }
        });
    }


    /**
     *  Agregar al detalle temporar 
     -----------------------------------------------------------*/

    $('#AgregarItem').on('click', (e) => {
        e.preventDefault();

        $('#AgregarItem').hide();

        var product_id = $('#product_id').val();
        var total_price = $('#total_price').val().replace(/,/g, "");
        var quantity = $('#quantity').val();
        var discount = $('#discount').val().replace(/,/g, "");

        var price = $('#price_out').val().replace(/,/g, "");
        var tax = $('#tax_value').val() / 100;

        reduceStock(product_id, quantity);

        $.ajax({
            url: SITE_URL + "functions/invoices.php",
            method: "post",
            data: {
                action: "agregarItem",
                userID: $('#user_id').val(),
                product_id: product_id,
                total_price: total_price,
                quantity: quantity,
                discount: discount,
                tax: (quantity * price) * tax

            },
            success: function (res) {

                // console.log(res)
                reload();

                invoiceTotal()

                // Default 
                $('#price_out').val('0.00');
                $('#total_price').val('0.00');
                $('#stock').val('0');
                $('#quantity').val('0');
                $('#barcode').val('');
                $('#description').val('-');
                $('#quantity').attr("disabled", true);
                $('#discount').attr("disabled", true);
                $('#total_price').attr("disabled", true);
                $('#select2-description-container').empty();
            }
        });

    })


    /*
    *Validar la cantidad del producto antes de agregar
    --------------------------------------------------- */

    $('#quantity').keyup(function (e) {
        e.preventDefault();

        clcTotalPrice();

    })

    function clcTotalPrice() {

        var stock = parseFloat($('#stock').val());
        var quantity = parseFloat($('#quantity').val());

        if (quantity <= stock) {

            var Precio_total = $('#quantity').val() * $('#price_out').val().replace(/,/g, "") - $('#discount').val();
            $('#total_price').val(format.format(Precio_total));

            // Ocultar la cantidad si es menor que 1

            if ($('#quantity').val() < 0.1 || isNaN($('#quantity').val())) {
                $('#AgregarItem').hide();
                $('#addPurchase').hide();
            } else {
                $('#AgregarItem').show();
                $('#addPurchase').show();
            }

        } else {
            $('#AgregarItem').hide();
            $('#addPurchase').hide();
            $('#total_price').val('0.00');
        }


    }

    // Aplicar descuento

    $('#discount').keyup(function (e) {
        e.preventDefault();

        clcTotalPrice();

    })

    // Reducir stock 

    function reduceStock(product_id, quantity) {

        var stock = $('#stock').val();

        var reduce_stock = stock - quantity;

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/invoices.php",
            data: {
                reduce: reduce_stock,
                product_id: product_id,
                action: 'reducirStock'
            },
            success: function (res) {

                //   console.log(res);

            }
        });
    }

    /** 
     * Procesar Venta 
     ------------------------------------------------------*/

    $('#processSale').on('click', (e) => {
        e.preventDefault();

        AddSale();
    });

    $('#printInvoice').on('click', (e) => {
        e.preventDefault();

        AddSaleAndPrint();

    })


    function AddSale() {

        if ($('#rows tr').length > 0) {
            if ($('#customer_id').val() < 1) {
                unknownCustomer();
            } else {
                CreateInvoice();
            }
        }

        // Crear cliente desconocido

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

        // Crear factura

        function CreateInvoice(contact_id) {

            // Verificar contact_id

            let customer_id;

            if (contact_id > 0) {
                customer_id = contact_id;
            } else {
                customer_id = $('#customer_id').val();
            }

            let Nofactura;

            if (localStorage.getItem('Nofactura') != null) {

                Nofactura = localStorage.getItem('Nofactura');

                $.ajax({
                    type: "post",
                    url: SITE_URL + "functions/invoices.php",
                    data: {
                        action: "procesarVenta",
                        customer_id: customer_id,
                        user_id: $('#user_id').val(),
                        payment_method: $('#payment_method').val(),
                        purchase: $('#purchase').val(),
                        noinvoice: Nofactura,
                        created_at: $('#date').val(),
                        expiration: $('#invoice_expiration').val()


                    },
                    beforeSend: function () {
                        $('.loader').show();
                    },
                    success: function (res) {

                        console.log(res);
                        
                        reload();
                        $('.totalContainer').hide();
                        $('.loader').hide();
                    }

                });

            } else {
                console.log("No se ha encontrado la factura");
            }
        }

    } // End function AddSale


    function AddSaleAndPrint() {

        if ($('#rows tr').length > 0) {
            if ($('#customer_id').val() < 1) {
                unknownCustomer();
            } else {
                CreateInvoice();
            }
        }

        // Crear cliente desconocido

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
                url: SITE_URL + "functions/invoices.php",
                data: {
                    action: "procesarVenta",
                    customer_id: customer_id,
                    user_id: $('#user_id').val(),
                    payment_method: $('#payment_method').val(),
                    purchase: $('#purchase').val(),
                    noinvoice: $('#nofactura').val(),
                    created_at: $('#date').val(),
                    expiration: $('#invoice_expiration').val()


                },
                success: function (res) {

                    console.log(res)

                    // $('#billingCustomer').load(location.href + " #billingCustomer");
                    // $('#Detalle').load(location.href + " #Detalle");
                    // $('.totalContainer').load(location.href + " .totalContainer");


                },
                complete: () => console.log('complete')

            });
        }
    } // End Function AddSaleAndPrint 




    /**
     *  Anular venta
     -----------------------------------*/

    $('#cancelSale').on('click', (e) => {
        e.preventDefault();

        cancelSale();
    })

    function cancelSale() {

        var rows = $('#rows tr').length;

        if (rows > 0) {

            alertify.confirm("<i class='text-danger fas fa-exclamation-circle'></i> Anular venta", "¿Desea anular la compra?",
                function () {

                    $.ajax({
                        type: "post",
                        url: SITE_URL + "functions/invoices.php",
                        data: {
                            action: "anularVenta",
                            userID: $('#user_id').val()
                        },
                        beforeSend: function (){
                            $('.loader').show()
                        },
                        success: function (res) {

                            $('#Detalle').load(location.href + " #Detalle");
                            $('.totalContainer').hide();
                            $('.loader').hide()
                           

                        }
                    });
                },
                function () {
                  
                });
        }
    }


    /**
     * Agregar productos a una factura
     ---------------------------------------------------*/

    $('#addPurchase').on('click', (e) => {
        e.preventDefault();

        $('#addPurchase').hide();

        addItemToDetail();
    })

    function addItemToDetail() {

        var product_id = $('#product_id').val();
        var total_price = $('#total_price').val().replace(/,/g, "");
        var invoice_id = $('#invoice_id').val();
        var quantity = $('#quantity').val();
        var discount = $('#discount').val().replace(/,/g, "");

        var price = $('#price_out').val();
        var tax = $('#tax_value').val() / 100;

        reduceStock(product_id, quantity);

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/invoices.php",
            data: {
                action: "agregarCompra",
                userID: $('#user_id').val(),
                invoice_id: invoice_id,
                product_id: product_id,
                total_price: total_price,
                quantity: quantity,
                discount: discount,
                tax: (quantity * price) * tax

            },
            success: function (res) {

                updatePriceInvoice(invoice_id);

                $('#Detalle').load(location.href + " #Detalle");

                detailTotal();

                // Default 
                $('#price_out').val('0.00');
                $('#total_price').val('0.00');
                $('#stock').val('0');
                $('#quantity').val('0');
                $('#barcode').val('');
                $('#description').val('-');
                $('#quantity').attr("disabled", true);
                $('#discount').attr("disabled", true);
                $('#total_price').attr("disabled", true);
                $('#select2-description-container').empty();


            }
        });


    }






}) // Exit ready;


const SITE_URL = "http://localhost/sistem/";
const format = new Intl.NumberFormat('en-CA', {
    style: 'currency',
    currency: 'DOP'
});

function invoiceTotal() {

    $('.totalContainer').show();

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/invoices.php",
        data: {
            action: 'obtenerDetalleTemp',
            userID: $('#user_id').val()
        },
        success: function (res) {

            var data = JSON.parse(res);

            var descuento = format.format(data.total_discount);
            var tax = format.format(data.tax);
            var subtotal = format.format(parseFloat(data.total) + parseFloat(data.total_discount));
            var total = format.format(parseFloat(data.total) + parseFloat(data.tax));

            var totalDB = parseFloat(data.total) + parseFloat(data.tax)

            var html = `
                        <div class="row col-md-12">
                        <div class="col-sm-6 priceContent">
                            <span class="text-right">Subtotal</span>
                            <span class="text-right">-Desc.</span>
                            <span class="text-right">+Impuestos</span>
                        </div>

                        <div class="col-sm-6 priceContent">
                            <span>${subtotal}</span>
                            <span>${descuento }</span>
                            <span>${tax}</span>

                        </div>
                    </div>

                    <div class="row col-md-12 finalTotalContent">
                        <div class="col-sm-6 priceContent">
                            <span class="text-right">Total</span>
                        </div>

                        <div class="col-sm-6 priceContent">
                            <input type="hidden" name="purchase" value="${totalDB}" id="purchase">
                            <span>${total}</span>
                        </div>
                    </div>`;

            $('.floatContainer').html(html);


        }
    });
}


// Eliminar Item del detalle temporar

function eliminarItem(idItem, product_id, total_quantity, stock) {

    $.ajax({
        url: SITE_URL + "functions/invoices.php",
        method: "post",
        data: {
            action: "eliminarItem",
            idItem: idItem
        },
        success: function (res) {
            if (res == 1) {

                // console.log(res)

                // Recuperar stock
                recoveryStock(product_id, total_quantity, stock);

                $('#Detalle').load(location.href + " #Detalle");
                invoiceTotal() // actualizar tabla precio

            }

        }
    });

}

// Recuperar stock

function recoveryStock(product_id, total_quantity, stock) {

    var recovery_stock = parseInt(total_quantity) + parseInt(stock);
    var action = 'recoveryStock';

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/invoices.php",
        data: {
            action: action,
            recovery: recovery_stock,
            product_id: product_id
        },
        success: function (res) {


        }
    });
}

// Tabla de precio de la factura #

function detailTotal() {

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/invoices.php",
        data: {
            action: 'obtenerDetalle',
            invoice_id: $('#invoice_id').val()

        },
        success: function (res) {

            var data = JSON.parse(res);

            var descuento = format.format(data.total_discount);
            var tax = format.format(data.tax);
            var subtotal = format.format(parseInt(data.total) + parseInt(data.total_discount));
            var total = format.format(parseInt(data.total) + parseInt(data.tax));

            var totalDB = parseFloat(data.total) + parseFloat(data.tax);

            var html = `
                        <div class="row col-md-12">
                        <div class="col-sm-6 priceContent">
                            <span class="text-right">Subtotal</span>
                            <span class="text-right">-Desc.</span>
                            <span class="text-right">+Impuestos</span>
                        </div>

                        <div class="col-sm-6 priceContent">
                            <span>${subtotal}</span>
                            <span>${descuento}</span>
                            <span>${tax}</span>

                        </div>
                    </div>

                    <div class="row col-md-12 finalTotalContent">
                        <div class="col-sm-6 priceContent">
                            <span class="text-right">Total RD$</span>
                        </div>

                        <div class="col-sm-6 priceContent">
                            <input type="hidden" name="purchase" value="${totalDB}" id="purchase">
                            <span>${total}</span>
                        </div>
                    </div>`;

            $('#ContainerTotalInvoice').html(html);


        }
    });
}

// Eliminar del detalle de factura

function deleteInvoiceDetail(invoice_detail_id, invoice_id, product_id, quantity, stock) {

    alertify.confirm("Eliminar compra", "¿Desea eliminar esta compra? ",
        function () {

            $.ajax({
                url: SITE_URL + "functions/invoices.php",
                method: "post",
                data: {
                    action: "eliminarDetalle",
                    invoice_detail_id: invoice_detail_id

                },
                beforeSend: function () {
                    $('.loader').show();
                },
                success: function (res) {
                    if (res == 1) {


                        recoveryStock(product_id, quantity, stock); // Recuperar stock
                        updatePriceInvoice(invoice_id); // Actualizar precio de factura

                        $('#Detalle').load(location.href + " #Detalle");
                        detailTotal() // Calcular detalle de factura

                        $('.loader').hide();

                    } else {
                        alertify.error('No se ha podido eliminar este compra');
                    }

                }
            });

        },
        function () {
           
        });
}

// Actualizar precio de factura

function updatePriceInvoice(invoice_id) {

    var action = "actualizarFactura";

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/invoices.php",
        data: {
            action: action,
            invoice_id: invoice_id
        },
        success: function (res) {
            console.log(res);
        }
    });
}

// Desactivar factura

function disabledInvoice(invoice_id) {

    alertify.confirm("<i class='text-warning fas fa-exclamation-circle'></i> Desactivar factura", "¿Está seguro de que desea desactivar esta factura? Esta operación no se puede deshacer. ",
        function () {

            $.ajax({
                type: "post",
                url: SITE_URL + "functions/invoices.php",
                data: {
                    invoiceID: invoice_id,
                    action: 'desactivarFactura'
                },
                beforeSend: function () {
                    $('.loader').show();
                },
                success: function (res) {
                    $('.loader').hide();
                    $('#example').load(location.href + " #example");
                }
            });

        },
        function () {
            
        });
}










// Actualizar factura a credito

function showCreditData(invoice_id) {

    var action = "mostrarDatosDeCredito";

    $.ajax({
        type: "post",
        url: SITE_URL + "functions/invoices.php",
        data: {
            action: action,
            invoice_id: invoice_id
        },
        success: function (res) {
            if (res != '') {
                var data = JSON.parse(res);

                $('#invoice_id').val(data.invoice_id);
                $('#customerCredit').val(data.name);
                $('#pending').val(format.format(data.pending));
                $('#totalCredit').val(format.format(data.total_invoice));
            }
        }
    });
}