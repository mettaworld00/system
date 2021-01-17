<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1> Servicios </h1>
        </div>


        <div class="float-right">
            <button class="btn btn-sm btn-success"><i class="fas fa-file-csv"></i> Excel</button>
            <a href="<?= base_url ?>billing/addpurchase" class="btn btn-sm btn-secondary">Nueva factura de servicio</a>
        </div>
    </div>
</div>



<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($element = $services->fetch_object()) : ?>
                <tr>
                    <td><?= $element->service_id ?></td>
                    <td><?= $element->service_name ?></td>
                    <td><?= $element->price ?></td>
                    <td><?= $element->status_name ?></td>
                    <td></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>