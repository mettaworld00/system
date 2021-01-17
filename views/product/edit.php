<?php $product = Help::showProductId($_GET['id']); while($element = $product->fetch_object()): ?>

    <div class="section-wrapper">
    <div class="align-content clearfix">
        <h1><i class="fas fa-box"></i> <?= $element->product_name ?></h1>
    </div>
</div>


    <div class="generalContainer">
        <div class="row col-md-12">
 
        <input type="hidden" name="" value="<?= $element->product_id?>" id="productId">

            <div class="form-group col-md-3 border-right">
                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Nombre<span class="text-danger">*</span></label>
                    <input class="form-custom col-sm-12" type="text" name="name" id="product_name" value="<?= $element->product_name ?>" placeholder="" required>
                </div>

                <label class="form-check-label" for="">Precio<span class="text-danger">*</span> </label>
                <div class="form-group mb-3">
                    <input type="number" name="price_out" class="form-custom col-sm-12" value="<?=  $element->price_out ?>" placeholder="" id="inputPrice_out" required>

                </div>


            </div>


            <div class="form-group col-md-2 border-right">
                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Código de producto <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></label>
                    <input class="form-custom col-sm-12" type="text" name="product_code" value="<?= $element->product_code ?>" placeholder="" id="product_code">
                </div>

                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Categorías <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></label>
                    <select class="form-custom search col-sm-12" name="category" id="category">
                        <option value="">Nínguno</option>
                        <option value="<?= $element->category_id ?>" selected><?= $element->category_name ?></option>
                        <?php $categories = Help::showCategories();
                        while ($category = $categories->fetch_object()) : ?>
                            <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                        <?php endwhile; ?>
                    </select>

                </div>

                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Impuesto %</label>
                    <select class="form-custom search col-sm-12" name="tax" id="tax">
                        <option value="<?= $element->tax_id ?>" selected><?= $element->tax_name ?></option>
                        <?php $taxes = Help::showTaxes();
                        while ($tax = $taxes->fetch_object()) : ?>
                            <option value="<?= $tax->tax_id ?>"><?= $tax->tax_name ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>


            </div> <!-- form-group col-md-3 -->

            <div class="form-group col-md-4">


                <div class="form-group">
                    <label for="">Precio total</label>
                    <div class="productPrice">

                        <span>RD$</span><input type="text" class="hidde" value="<?= $element->price_out?>" id="precioTotal" disabled>
                        <input type="hidden" name="" value="" id="FinalPrice_out">
                    </div>
                </div>
            </div>

        </div> <!-- Row col-md-12 -->

        <div class="col-md-11 mt-4" id="inventoryItem">

            <h4>Inventario</h4>

            <div class="form-group row pt-2">
                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Unidad de medida</label>
                    <select class="form-custom col-sm-12 search" name="unit" id="unit">
                        <option value="<?= $element->unit_id ?>" selected><?= $element->unit_name ?></option>
                        <?php $units = Help::showUnits();
                        while ($unit = $units->fetch_object()) : ?>
                            <option value="<?= $unit->unit_id ?>"><?= $unit->unit_name ?> </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Precio compra</label>
                    <input type="number" name="price_in" class="form-custom col-sm-12 " id="inputPrice_in" value="<?= $element->price_in ?>" placeholder="0.00">
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Total de unidades<span class="text-danger">*</span></label>
                    <input class="form-custom col-sm-12" type="number" name="quantity" value="<?= $element->quantity ?>" placeholder="Vacío" id="productQuantity" required>
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Miníma unidad <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></label>
                    <input class="form-custom col-sm-12" type="number" value="<?= $element->inventary_min ?>" name="inventary_min" id="min_quantity" placeholder="Vacío">
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Almacen <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></label>
                    <select class="form-custom  search col-sm-12" name="warehouse" id="warehouse">
                        <option value="<?= $element->warehouse_id ?>" selected><?= $element->warehouse_name ?></option>
                        <?php $warehouses = Help::showWarehouses();
                        while ($warehouse = $warehouses->fetch_object()) : ?>
                            <option value="<?= $warehouse->warehouse_id ?>"><?= $warehouse->warehouse_name ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
        </div>


    </div> <!-- GeneralContainer -->

    <div class="buttons clearfix">
        <div class="floatButtons">
            <a class="btn btn-danger" href="<?= base_url ?>product/index">Cancelar</a>
            <!-- <input class="btn btn-secondary " type="button" value="Guardar y crear nueva" id="createNewProduct"> -->
            <input class="btn btn-primary " type="button" value="Guardar" id="updateProduct">
        </div>
    </div>

    <?php endwhile; ?>

