<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1>Ingresos </h1>
        </div>


        <div class="float-right">
            <button class="btn btn-sm btn-success"><i class="fas fa-file-csv"></i> Excel</button>
        </div>
    </div>
</div>



<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>N°</th>
                <th>Cliente</th>
                <th>Factura</th>
                <th>Valor recibido</th>
                <th>Condición</th>
                <th>Nota</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($element = $payments->fetch_object()) : ?>
                <tr>
                    <td><?= $element->payment_id ?></td>
                    <td><?= $element->customer_name ?></td>
                    <td><?= $element->noinvoice ?></td>
                    <td><?= number_format($element->received, 2) ?></td>
                    <td><?= $element->payment_name ?></td>
                    <td class="note-width"><?= $element->note ?></td>
                    <td><?= $element->created_at ?></td>
                    <td>
                        <span onclick="deleteInvoice('<?= $element->invoice_id ?>')" class="action-delete">
                        <i class="fas fa-times"></i>
                        </span>
                    </td>

                    
                </tr>
            <?php endwhile; ?>
        </tbody>

    </table>

</div>