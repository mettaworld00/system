<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1> Servicios </h1>
        </div>


        <div class="float-right">
            <button class="btn btn-sm btn-success"><i class="fas fa-file-csv"></i> Excel</button>
            <a href="<?= base_url ?>services/addpurchase" class="btn btn-sm btn-secondary">Nueva factura de servicio</a>
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
                <?php $parents = Help::verify_parent_service($element->service_id); while ($parent = $parents->fetch_object()) { ?>

                <tr>
                    <td><?= $element->service_id ?></td>
                    <td><?= $element->service_name ?></td>
                    <td><?= $element->price ?></td>
                    <td class="<?= $element->status_name ?>"><?= $element->status_name ?></td>
                    <td>
                        <span class="<?php if ($element->status_name == 'Activo'){ ?> action-active  <?php } else { ?> action-delete <?php } ?>" 
                        <?php if ($element->status_name == 'Activo') { ?>  onclick="disableService('<?= $element->service_id ?>')" <?php } else { ?> onclick="enableService('<?= $element->service_id ?>')" <?php } ?>
                        <?php if ($element->status_name == 'Activo'){ ?> title="Desactivar servicio"  <?php } else { ?> title="Activar" <?php } ?> id="">
                              <i class="fas fa-lightbulb"></i>
                        </span>
                        
                        <span <?php if ($parent->parent_row == 0) { ?> class="action-delete" onclick="deleteService('<?= $element->service_id ?>')"  <?php } else { ?> class=" action-delete action-disable" <?php } ?> title="Eliminar">
                        <i class="fas fa-times"></i>
                        </span>
                    </td>
                </tr>
            <?php } endwhile; ?>
        </tbody>
    </table>

</div>