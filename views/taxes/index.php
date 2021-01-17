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
           <tr>
               <td><?= $element->tax_id?></td>
               <td><?= $element->tax_name?></td>
               <td><?= $element->tax_value ?>%</td>
               <td><?= $element->observation ?></td>
               
               <td>
               <span onclick="deleteTax('<?= $element->tax_id ?>')" class="action-delete"><i class="fas fa-trash-alt"></i></span>
               </td>
           </tr>
           <?php endwhile; ?>
        </tbody>
     
    </table>

</div>


