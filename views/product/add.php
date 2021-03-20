<div class="section-wrapper">
    <div class="align-content clearfix">
        <h1><i class="fas fa-box"></i> Nuevo ítem de venta</h1>
    </div>
</div>


<div class="generalContainer">
    <form action="" onsubmit="event.preventDefault(); addNewProduct('<?= $_SESSION['identity']->user_id ?>');">
        <div class="row col-md-12">

            <div class="form-group col-md-3 border-right">
                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Nombre<span class="text-danger">*</span></label>
                    <input class="form-custom col-sm-12" type="text" name="name" id="product_name" placeholder="" required>
                </div>

                <label class="form-check-label" for="">Precio<span class="text-danger">*</span> </label>
                <div class="form-group mb-3">
                    <input type="number" name="price_out" class="form-custom col-sm-12" placeholder="" id="inputPrice_out" required>

                    <a class="price_list" href="#">Utilizar lista de precio</a>
                    <div class="list mt-2">


                        <div class="d-flex mb-1 selects">

                            <select class="form-custom col-sm-6" name="" id="price_list">
                                <option value="no" selected>Nínguno</option>
                                <?php $price_lists = Help::showPrice_list();
                                while ($list = $price_lists->fetch_object()) : ?>

                                    <option value="<?= $list->list_value ?>" list_id="<?= $list->list_id ?>"><?= $list->list_name ?> - <?= $list->list_value ?>%</option>
                                <?php endwhile; ?>
                            </select>

                            <div class="col-sm-6">
                                <input class="form-custom col-sm-10" type="text" name="list" id="list_value" disabled>
                            </div>

                        </div>
                        <a class="text-primary addlist" href="#">Agregar</a>

                        <div class="pricelist_container d-flex mt-3">
                            <ul class="list_titles mr-5">

                            </ul>
                        </div>

                    </div>
                </div>

            </div>


            <div class="form-group col-md-2 border-right">
                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Código de producto<span class="text-danger">*</span> <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></label>
                    <input class="form-custom col-sm-12" type="text" name="product_code" placeholder="" id="product_code" required>
                </div>

                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Categorías <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></label>
                    <select class="form-custom search col-sm-12" name="category" id="category">
                        <?php $categories = Help::showCategories();
                        while ($category = $categories->fetch_object()) : ?>
                            <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                        <?php endwhile; ?>
                    </select>

                </div>

                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Impuesto %</label>
                    <select class="form-custom search col-sm-12" name="tax" id="tax">

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

                        <span>RD$</span><input type="text" class="hidde" id="precioTotal" disabled>
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
                        <?php $units = Help::showUnits();
                        while ($element = $units->fetch_object()) : ?>
                            <option value="<?= $element->unit_id ?>"><?= $element->unit_name ?> </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Precio compra<span class="text-danger">*</span></label>
                    <input type="number" name="price_in" class="form-custom col-sm-12 " id="inputPrice_in" placeholder="0.00" required>
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Total de unidades<span class="text-danger">*</span></label>
                    <input class="form-custom col-sm-12" type="number" name="quantity" placeholder="Vacío" id="product_quantity" required>
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Miníma unidad <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></label>
                    <input class="form-custom col-sm-12" type="number" name="inventary_min" id="min_quantity" placeholder="Vacío">
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Expiración <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></label>
                    <input class="form-custom col-sm-12" type="date" name="expiration" id="inputExpiration">
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Almacen <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></label>
                    <select class="form-custom  search col-sm-12" name="warehouse" id="warehouse">
                        <?php $warehouses = Help::showWarehouses();
                        while ($warehouse = $warehouses->fetch_object()) : ?>
                            <option value="<?= $warehouse->warehouse_id ?>"><?= $warehouse->warehouse_name ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
        </div>

        <br> <br>

        <div class="buttons clearfix">
            <div class="floatButtons">
                <a class="btn btn-danger" href="<?= base_url ?>product/index">Cancelar</a>
                <!-- <input class="btn btn-secondary " type="button" value="Guardar y crear nueva" id="createNewProduct"> -->
                <input class="btn btn-primary " type="submit" value="Guardar" id="createProduct">
            </div>
        </div>


    </form>
</div> <!-- GeneralContainer -->