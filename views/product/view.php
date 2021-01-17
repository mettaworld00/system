<?php $product = Help::showProductId($_GET['id']);
while ($element = $product->fetch_object()) : ?>

    <div class="section-wrapper" id="title">
        <div class="align-content ">
            <h1></h1>
        </div>
    </div>


    <div class="section-wrapper">
        <button class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i> Facturar este ítem</button>
        <a class="btn btn-sm"></a>
    </div>

    <div class="generalContainer">
            <div class="row col-md-12">

                <input type="hidden" name="product_id" value="">

                <div class="form-group col-md-3 border-right">
                    <div class="form-group">
                        <label for="">Nombre<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm input-border-botton" type="text" name="name" id="" value="<?= $element->product_name ?>" placeholder="Vacío" disabled>
                    </div>

                    <label for="">Precio de compra</label>
                    <div class="form-group">
                        <input type="text" name="price_in" class="form-control form-control-sm input-border-botton" value="<?= $element->price_in ?>" placeholder="Vacío" disabled>
                    </div>

                    <label for="">Precio<span class="text-danger">*</span></label>
                    <div class="form-group">

                        <input type="text" name="price_out" class="form-control form-control-sm input-border-botton" value="<?= $element->price_out ?>" id="inputPrecio" placeholder="Vacío" disabled>
                    </div>

                    <div class=" form-group">
                        <label for="">Cantidad<span class="text-danger">*</span></label>
                        <input class="form-control form-control-sm input-border-botton" type="number" name="quantity" value="<?= $element->quantity ?>" placeholder="Vacío" disabled>
                    </div>

                    <div class=" form-group">
                        <label for="">Mínimo inventario</label>
                        <input class="form-control form-control-sm input-border-botton" type="number" name="inventary_min" value="<?= $element->inventary_min ?>" placeholder="Vacío" disabled>
                    </div>

                </div>

                <div class="form-group col-md-3  border-right">
                    <div class="form-group">
                        <label for="">Código de producto</label>
                        <input class="form-control form-control-sm input-border-botton" type="text" name="product_code" value="<?= $element->product_code ?>" placeholder="Vacío" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Categoría</label>
                        <input class="form-control form-control-sm input-border-botton" type="text" name="category_name" value="<?= $element->category_name ?>" placeholder="Vacío" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Impuestos</label>
                        <input class="form-control form-control-sm input-border-botton" type="text" name="tax_name" value="<?= $element->tax_name ?>" placeholder="Vacío" disabled>
                        

                    </div>


                </div> <!-- form-group col-md-3 -->

                <div class="form-group col-md-3">


                    <div class="form-group">
                        <label for="">Precio total</label>
                        <div class="productPrice">

                            <span>RD$</span><input type="text" class="hidde" value="" id="precioTotal" disabled>
                        </div>
                    </div>
                </div>

            </div> <!-- Row col-md-12 -->

          

    </div>


    <div class="generalContainer">
        <h6 class="ml-1 mb-3">Lista de precios</h6>

        <?php $datos = Help::showPriceListProduct($element->product_id); while($list = $datos->fetch_object()): ?>
        <div class="generalPriceList">
            <span><?= $list->list_name ?></span>
            <span>RD$</span>
        </div>
        <?php endwhile; ?>
    </div>



<?php endwhile; ?>