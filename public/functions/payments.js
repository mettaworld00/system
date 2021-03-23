$(document).ready(function () {
    const SITE_URL = "http://localhost/sistem/";




}); // Exit ready



function Addpayment() {

    alertify.confirm("Agregar pago", "¿Está seguro de que desea agregar un pago a esta factura ? ",
        function () {

            $.ajax({
                type: "post",
                url: SITE_URL + "functions/payments.php",
                data: {
                    action: "agregarPago",
                    debtor_id: $('#debtor_id').val(),
                    invoice_id: $('#invoice_id').val(),
                    payment_method: $('#payment_method').val(),
                    note: $('#payment_note').val(),
                    date: $('#date').val(),
                    value: $('#received_value').val()
                },
                beforeSend: function () {
                    $('.loader').show();
                },
                success: function (res) {
                    console.log(res);
                    $('.loader').hide();
                }
            });

        },
        function () {

        });

} // End Function