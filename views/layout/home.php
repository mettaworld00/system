<h4><i class="fas fa-globe"></i> Panel de control</h4> <br>
<div class="navigation">

  <div class="nav">
    <div class="icon" icon="barcode"><i class="fas fa-barcode"></i></div>
    <div class="info">
      <a>Productos</a>
      <strong>100</strong>
    </div>
  </div>

  <div class="nav">
    <div class="icon" icon="store"><i class="fas fa-store"></i></div>
    <div class="info">
      <a>Pedídos</a>
      <strong>3</strong>
    </div>
  </div>

  <div class="nav">
    <div class="icon" icon="stock"><i class="fas fa-box-open"></i></div>
    <div class="info">
      <a>Stock</a>
      <strong>87</strong>
    </div>
  </div>

  <div class="nav">
    <div class="icon" icon="users"><i class="fas fa-users"></i></div>
    <div class="info">
      <a>Clientes</a>
      <strong>25</strong>
    </div>
  </div>

</div>

<br><br>

<!-- Gráficos -->



<div class="container-chart">
  <div class="row hola">

    <div class="col-sm-4 chart">
      <canvas id="SalesOfWeek" ></canvas>
    </div>

    <div class="col-sm-4 chart">
      <canvas id="SalesOfMonth" ></canvas>
    </div>
    
  </div>
</div>


<h4>Ventas del día</h4>
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
            <?php while ($element = $sales->fetch_object()) : ?>
                <tr>
                    <td><?= $element->noinvoice ?></td>
                    <td><?= $element->customer_name ?></td>
                    <td><?= $element->date ?></td>
                    <td><?= $element->expiration ?></td>
                    <td><?= number_format($element->total_invoice, 2) ?></td>
                    <td style="color: #0cdd0c; font-weight: bold"><?= number_format($element->money_received, 2) ?></td>
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

<!-- Total vendido -->

<div class="buttons clearfix">
    <div class="floatButtons">
        <div class="inventoryTable">
            <span>Total vendido</span>
            
            <p><?= $symbol." ".$result ?></p>
          
        </div>
    </div>
</div>




