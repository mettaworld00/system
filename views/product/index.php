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
                <th>Exist.</th>
                <th>P/Comp</th>
                <th>P/Unit</th>
                <th>Acciones</th>
            </tr>
        </thead>



        <tbody>
            <?php  while ($product = $products->fetch_object()) : ?>
                <tr>
                    <td><?= $product->product_code ?></td>
                    <td><?= $product->product_name ?> </td>

                    <?php if($product->quantity > $product->inventary_min){?>
                        <td class="text-success">Hay existencía (<?= $product->quantity ?>)</td>
                  
                    <?php } else if($product->quantity < 1) { ?>
                    <td class="text-danger">Agotado (<?= $product->quantity ?>)</td>
                    <?php } else if($product->quantity <= $product->inventary_min) { ?>
                        <td class="text-warning">Casi agotado (<?= $product->quantity ?>)</td>
                    <?php }; ?>

                    <td><?=  number_format($product->price_in) ?></td>
                    <td><?=  number_format($product->price_out) ?></td>
                    <td>

                        <a href="<?=base_url?>product/view&id=<?=$product->product_id?>">
                        <span class="action-view"><i class="fas fa-eye"></i></span>
                        </a>

                        <a href="<?=base_url?>product/edit&id=<?=$product->product_id?>">
                        <span class="action-edit"><i class="fas fa-pencil-alt"></i></span>
                        </a>
                        
                        <span onclick="deleteProduct('<?= $product->product_id ?>')" class="action-delete"><i class="fas fa-trash-alt"></i></span>
                      
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>