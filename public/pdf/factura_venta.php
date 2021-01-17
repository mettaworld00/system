<?php ob_start(); ?>


<style>
   

    * {
        padding: 0;
        margin: 0;
        font-family:Verdana, Geneva, Tahoma, sans-serif;
    }

    ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    li {
        font-size: 15px;
    }

    .container {
        width: 90%;
        margin: 0 auto;
    }


    .header {
        text-align: center;
    }

    .info-invoice {
        width: 100%;
    }

    .info-invoice ul li {
        font-weight: 600;
    }

    .table-invoice {
        margin-top: 10px;
    }

    .table-invoice thead {
        border-top: 2px solid #494949;
        border-bottom: 2px solid #494949;
    }


    table {
        width: 100%;
        text-align: justify;
        border-collapse: collapse;

    }

    .table-invoice thead th {
        padding: 5px;
        font-size: 15px;

    }

    .table-invoice td {
        padding: 5px;
        font-size: 15px;
    }

    .container-price {
        padding-top: 10px;
        border-top: 2px solid #494949;
    }

    .titles,
    .prices {
        font-weight: 600;
    }

    .footer {
        text-align: center;
    }
</style>


<div class="container">

    <div class="header">
        <h1>LOGO</h1>
        <p>Dirección</p>
        <p>Télefono:</p>
    </div>

    <br><br>

    <table class="info-invoice" style="width: 100%;">
        <thead>
            <tr>
                <th style="width: 18%;">
                    <ul>
                        <li>N° Factura:</li>
                        <li style="margin-top: 10px;">Fecha:</li>
                        <li>Válido Hasta:</li>
                    </ul>

                    <ul style="margin-top: 10px;">
                        <li>Vendido por:</li>
                        <li>Sucursal:</li>
                        <li>Condición:</li>
                    </ul>

                    <ul style="margin-top: 10px;">
                        <li>Cliente:</li>
                        <li>RNC:</li>
                        <li>Télefono:</li>
                        <li>Dir:</li>
                    </ul>
                </th>

                <th style="width: 82%;">
                    <ul>
                        <li><?php echo $_POST['InvoiceID'] ?></li>
                        <li style="margin-top: 10px;">06/01/2021 10:32 AM</li>
                        <li>10/01/2021</li>
                    </ul>

                    <ul style="margin-top: 10px;">
                        <li>Wilmin José Sánchez Francisco</li>
                        <li>Mamey</li>
                        <li>Contado</li>
                    </ul>

                    <ul style="margin-top: 10px;">
                        <li>-</li>
                        <li>-</li>
                        <li>-</li>
                        <li>-</li>
                    </ul>
                </th>


            </tr>
        </thead>
    </table>

    <table class="table-invoice" style="margin-top: 25px;">
        <thead>
            <tr>
                <th>Cant.</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Total $:</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>Iphone 11 Pro Max</td>
                <td>35,000</td>
                <td>35,000</td>
            </tr>

            <tr>
                <td>3</td>
                <td>Glass Iphone 11 Pro</td>
                <td>350</td>
                <td>1,050</td>
            </tr>
        </tbody>


        <tbody class="container-price">
            <td></td>
            <td></td>
            <td class="titles">
                <ul>
                    <li>Subtotal</li>
                    <li style="font-weight: 400;">Desc</li>
                    <li style="font-weight: 400;">Itbis</li>
                    <li style="font-size: 19px;">Total</li>
                </ul>
            </td>
            <td class="prices">
                <ul>
                    <li>200.01</li>
                    <li style="font-weight: 400;">0.00</li>
                    <li style="font-weight: 400;">0.00</li>
                    <li style="font-size: 19px;">200.01</li>
                </ul>
            </td>
        </tbody>

    </table>
    <br>

    <div class="footer">
        <span>Para reclamar debe presentar su factura</span>

        <br> <br>
        <p>Gracias por preferirnos !</p>


    </div>

</div>




<?php

require_once 'dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new DOMPDF();

$dompdf->load_html(ob_get_clean());

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

$pdf = $dompdf->output();

$dompdf->stream('Factura.pdf');

?>