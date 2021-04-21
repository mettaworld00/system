<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1> Catagorías</h1>
        </div>


        <div class="float-right">
            <a href="<?=base_url?>categories/add" class="btn btn-sm btn-secondary">Nueva Categoría</a>
        </div>
    </div>
    <p class="title-info">Utiliza las categorías para clasificar tus productos.</p>
</div>



<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Observación</th>
                <th></th>
            </tr>
        </thead>


      
        <tbody>
        <?php while($element = $categories->fetch_object()): ?>
            <?php $parents = Help::verify_parent_category($element->category_id); while ($parent = $parents->fetch_object()) { ?>

           <tr>
               <td><?= $element->category_id?></td>
               <td><?= $element->category_name?></td>
               <td><?= $element->observation ?></td>
               <td>

               <a class="action-edit" href="<?= base_url.'categories/edit&id='.$element->category_id ?>" title="Editar"> 
                <i class="fas fa-pencil-alt"></i>
                </a>

                <span <?php if ($parent->parent_row == 0) { ?> class="action-delete" onclick="deleteCategory('<?= $element->category_id ?>')" <?php } else { ?> class="action-delete action-disable" <?php } ?> title="Eliminar">
                <i class="fas fa-times"></i>
                </span>
               </td>
           </tr>
           <?php  } endwhile; ?>
        </tbody>
     
    </table>

</div>




<!-- Modal -->
<div class="modal fade" id="categoriesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva categoría</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="formAddCategories">
                    <div class="form-group">
                        <label for="">Nombre<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm" type="text" name="name" id="" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="createNewCategorie">Guardar</button>
            </div>
        </div>
    </div>
</div>