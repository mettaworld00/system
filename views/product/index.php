<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
        <h1><i class="fas fa-box-open"></i> Productos</h1>
        </div>
       

        <div class="float-right">
        <button class="btn btn-sm btn-success"><i class="fas fa-file-csv"></i> Excel</button>
        <a href="<?=base_url?>product/add" class="btn btn-sm btn-secondary">Nuevo ítem de venta</a>
        </div>
    </div>
</div>



<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php  while ($product = $products->fetch_object()) : ?>
                <tr>
                    <td><?= $product->product_code ?></td>
                    <td><?= $product->product_name ?> </td>

                    <?php if($product->quantity > $product->inventary_min){?>
                        <td class="text-success"><?= $product->quantity ?></td>
                  
                    <?php } else if($product->quantity < 1) { ?>
                    <td class="text-danger"><?= $product->quantity ?></td>
                    <?php } else if($product->quantity <= $product->inventary_min) { ?>
                        <td class="text-warning"><?= $product->quantity ?></td>
                    <?php }; ?>

                    <td><?= $symbol." ".number_format($product->price_out) ?></td>
                    <td>

                        <a href="<?=base_url?>product/view&id=<?=$product->product_id?>">
                        <span class="action-view"><i class="fas fa-eye"></i></span>
                        </a>

                        <a  class="action-edit <?php if ($product->status_name != 'Activo') { ?> action-disable <?php } ?> " 
                                 href="<?php if ($product->status_name == 'Activo') { 
                                     echo base_url.'product/edit&id='.$product->product_id; 
                                     } else { echo '#'; } ?> "> 
                              <i class="fas fa-pencil-alt"></i>
                        </a>

                        <span class="<?php if ($product->status_name == 'Activo'){ ?> action-active  <?php } else { ?> action-delete <?php } ?>" 
                        <?php if ($product->status_name == 'Activo') { ?>  onclick="disableProduct('<?= $product->product_id ?>')" <?php } else { ?> onclick="enableProduct('<?= $product->product_id ?>')" <?php } ?>
                        <?php if ($product->status_name == 'Activo'){ ?> title="Desactivar ítem"  <?php } else { ?> title="Activar ítem" <?php } ?> id="">
                              <i class="fas fa-lightbulb"></i>
                        </span>
                        
                        <span onclick="deleteProduct('<?= $product->product_id ?>')" class="action-delete"><i class="fas fa-trash-alt"></i></span>
                      
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>