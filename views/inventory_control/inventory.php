<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1><i class="fas fa-box-open"></i> Valor de inventario</h1>
        </div>

    </div>
</div>

<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>ítem</th>
                <th>Código</th>
                <th>Cantidad</th>
                <th>Unidad</th>
                <th>Estado</th>
                <th>Costo promedio</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($element = $products->fetch_object()) : ?>
                <tr>
                    <td><?= $element->product_name ?></td>
                    <td><?= $element->product_code ?></td>
                    <td><?= $element->quantity ?></td>
                    <td><?= $element->unit_name ?></td>
                    <th class="<?= $element->status_name ?>"><?= $element->status_name ?></th>
                    <td><?= $symbol." ".number_format($element->price_in, 2) ?></td>
                    <td>
                        <?php
                        $total = ($element->quantity * $element->price_in);
                        echo $symbol." ".number_format($total, 2);
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>

<div class="buttons clearfix">
    <div class="floatButtons">
        <div class="inventoryTable">
            <span>Valor de inventario</span>
            
            <p><?= $symbol." ".$result ?></p>
          
        </div>
    </div>
</div>