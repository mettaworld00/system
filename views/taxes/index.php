<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1>Impuestos</h1>
        </div>


        <div class="float-right">
            <a href="<?=base_url?>taxes/add" class="btn btn-sm btn-secondary">Nuevo Impuesto</a>
        </div>
    </div>
</div>



<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Valor</th>
                <th>Observación</th>
                <th></th>
            </tr>
        </thead>


      
        <tbody>
        <?php while($element = $taxes->fetch_object()): ?>
            <?php $parents = Help::verify_parent_tax($element->tax_id); while ($parent = $parents->fetch_object()) { ?>

           <tr>
               <td><?= $element->tax_id?></td>
               <td><?= $element->tax_name?></td>
               <td><?= $element->tax_value ?>%</td>
               <td class="note-width"><?= $element->observation ?></td>
               
               <td>

                <a class="action-edit" href="<?= base_url.'taxes/edit&id='.$element->tax_id; ?> title="Editar""> 
                <i class="fas fa-pencil-alt"></i>
                </a>

                <span <?php if ($parent->parent_row == 0) { ?> class="action-delete" onclick="deleteTax('<?= $element->tax_id ?>')" <?php } else { ?> class="action-delete action-disable" <?php } ?> title="Eliminar">
                <i class="fas fa-times"></i>
                </span>
               </td>
           </tr>

           <?php } endwhile; ?>
        </tbody>
     
    </table>

</div>


