<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1> Facturas </h1>
        </div>


        <div class="float-right">
            <button class="btn btn-sm btn-success"><i class="fas fa-file-csv"></i> Excel</button>
            <a href="<?= base_url ?>billing/addpurchase" class="btn btn-sm btn-secondary">Nueva factura</a>
        </div>
    </div>
</div>



<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>N°</th>
                <th>Cliente</th>
                <th>Creación</th>
                <th>Expiración</th>
                <th>Total</th>
                <th>Cobrado</th>
                <th>Por cobrar</th>
                <th>Estado</th>

                <th>Acciones</th>
            </tr>
        </thead>


        <tbody>
            <?php while ($element = $invoices->fetch_object()) : ?>
                <tr>
                    <td><?= $element->noinvoice ?></td>
                    <td><?= $element->customer_name ?></td>
                    <td><?= $element->date ?></td>
                    <td><?= $element->expiration ?></td>
                    <td><?= number_format($element->total_invoice, 2) ?></td>
                    <td><?= number_format($element->money_received, 2) ?></td>
                    <td><?= number_format($element->pending, 2) ?></td>
                    <td>
                        <p class="<?= $element->status_name ?>"><?= $element->status_name ?></p>
                    </td>

                    <td>
                        <a href="<?= base_url ?>product/view&id=<?= $element->invoice_id ?>">
                            <span class="action-view"><i class="fas fa-eye"></i></span>
                        </a>

                        <a  class="action-edit <?php if ($element->status_name == 'Pagada' || $element->status_name == 'Anulada') { ?> action-disable <?php } ?> " 
                                 href="<?php if ($element->status_name == 'Por cobrar') { 
                                     echo base_url.'invoices/edit&id='.$element->invoice_id; 
                                     } else { echo '#'; } ?> "> 
                            
                              <i class="fas fa-pencil-alt"></i>
                        </a>

                        <span class="action-delete <?php if ($element->status_name == 'Anulada'): ?> action-disable  <?php endif; ?>" 
                        <?php if ($element->status_name != 'Anulada') { ?>  onclick="disabledInvoice('<?= $element->invoice_id ?>')" <?php } ?> title="Desactivar" id="">
                            <i class="fas fa-minus-square"></i>
                        </span>



                        <span onclick="deleteInvoice('<?= $element->invoice_id ?>')" class="action-delete"><i class="fas fa-trash-alt"></i></span>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>

    </table>

</div>