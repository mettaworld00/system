<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
        <h1>Lista de precios</h1>
        </div>
       

        <div class="float-right">
        <button class="btn btn-sm btn-success"><i class="fas fa-file-csv"></i> Excel</button>
        <a href="<?=base_url?>price_list/add" class="btn btn-sm btn-secondary">Nuevo lista de precios</a>
        </div>
    </div>
</div>



<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nombre</th>
                <th>Porcentaje</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while($list = $price_list->fetch_object()): ?>
           <tr>
               <td><?= $list->list_id?></td>
               <td><?= $list->list_name?></td>
               <td>Porciento %(<?= $list->list_value ?>) </td>
               <td><?= $list->observation?></td>
                    <td>

                        <a href="<?=base_url?>price_list/view&id=<?=$list->list_id?>">
                        <span class="action-view"><i class="fas fa-eye"></i></span>
                        </a>

                        <a href="<?=base_url?>product/edit&id=<?=$product->product_id?>">
                        <span class="action-edit"><i class="fas fa-pencil-alt"></i></span>
                        </a>
                        
                        <span onclick="" class="action-delete"><i class="fas fa-trash-alt"></i></span>
                      
                    </td>
                </tr>
<?php endwhile; ?>
        </tbody>
    </table>

</div>