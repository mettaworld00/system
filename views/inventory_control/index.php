<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
        <h1>Ajustes de inventario</h1>
        </div>
       

        <div class="float-right">
        <button class="btn btn-sm btn-success"><i class="fas fa-file-csv"></i> Excel</button>
        <a href="<?=base_url?>inventory_control/add" class="btn btn-sm btn-secondary">Nuevo ajuste de inventario</a>
        </div>
    </div>
</div>



<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>No.</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Observación</th>
                <th>Acciones</th>
            </tr>
        </thead>



        <tbody>
          <?php  while ($setting = $settings->fetch_object()) : ?>
           <tr>
               <td><?=$setting->item_setting_id?></td>
               <td><?=$setting->created_at?></td>
               <td><?= number_format($setting->total_setting)?></td>
               <td><?=$setting->observation?></td>
                    <td>

                        <a href="<?=base_url?>product/view&id=<?=$product->product_id?>">
                        <span class="action-view"><i class="fas fa-eye"></i></span>
                        </a>
                        
                        <span onclick="" class="action-delete"><i class="fas fa-trash-alt"></i></span>
                      
                    </td>
                </tr>
                <?php endwhile; ?>
        </tbody>
    </table>

</div>