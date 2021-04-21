<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1>Nuevo ajuste de inventario</h1>
        </div>

    </div>
</div>

<div class="generalContainer">
    <form action="" onsubmit="event.preventDefault(); addSettings('<?= $_SESSION['identity']->user_id ?>');">

        <div class="container ">

            <div class="form-group col-md-6">

                <div class="form-group row">
                    <label for="" class="col-sm-3 text-right ">Fecha</label>
                    <div class="col-md-7">
                        <input class="form-custom col-md-12" type="date" name="" id="" value="<?php date_default_timezone_set('America/Los_Angeles');
                                                                                                echo date('Y-m-d'); ?>" required>
                    </div>
                </div>

            </div>

            <div class="form-group col-md-6 mt-3">

                <div class="d-flex">
                    <label for="" class="col-sm-3 text-right">Observación </label>

                    <textarea class="form-custom" name="" id="observation_setting" cols="50" rows="6" required></textarea>

                </div>
            </div>





        </div> <!-- Row col-md-12 -->
        <br>

        <table class="DetalleTemp">
            <thead>
                <th>Item</th>
                <th>Cantidad actual</th>
                <th>Tipo de ajuste</th>
                <th>Cantidad</th>
                <th>Cantidad final</th>
                <th>Costo</th>
                <th>Total ajustado</th>
                <th></th>
            </thead>

            <form action="" id="form">
                <tbody >
                    <tr>
                        <td>
                            <select class="form-custom search col-sm-7" name="" id="description_setting">
                                <option value="" selected></option>
                                <?php $items = Help::showProducts();
                                while ($item = $items->fetch_object()) : ?>

                                    <option value="<?= $item->product_id ?>"><?= $item->product_name ?></option>

                                <?php endwhile; ?>
                            </select>
                        </td>
                        <td><input class="invisible-input" name="cantidad-actual" type="text" id="current_quantity_setting" disabled></td>
                        <td>
                            <select name="" id="type_setting" class="form-control form-control-sm search">
                                <?php $settings = Help::showType_item_setting();
                                while ($setting = $settings->fetch_object()) : ?>

                                    <option value="<?= $setting->type_item_setting_id ?>"><?= $setting->item_setting_name ?></option>

                                <?php endwhile; ?>
                            </select>
                        </td>
                        <td><input class="no-border" name="cantidad" type="number" id="quantity_setting"></td>
                        <td><input class="invisible-input" name="cantidad-final" type="number" id="final_quantity_setting" disabled></td>
                        <td><input class="no-border" name="P/unit" type="number" id="price_in_setting"></td>
                        <td><input class="invisible-input" name="total" type="text" id="total_setting" disabled></td>
                        <td></td>
                    </tr>
                </tbody>
            </form>
        </table>

        <div class="buttons clearfix">
            <div class="floatButtons">
                <button class="btn btn-sm btn-primary" id="addRow">Agregar</button>
            </div>
        </div>



        <table id="Detalle_setting" class="DetalleTemp mt-2">
            <thead>
                <th>Item</th>
                <th>Cantidad actual</th>
                <th>Tipo de ajuste</th>
                <th>Cantidad</th>
                <th>Cantidad final</th>
                <th>Total ajustado</th>
                <th></th>
            </thead>



            <tbody id="rows_settings">

            </tbody>

        </table>
        <br>

        <div class="totalContainer clearfix ">
            <div class="floatContainer">
                <div class="row col-md-12 text-center">
                    <div class="col-sm-6 priceContent">
                        <span class="text-right">Total</span>

                    </div>

                    <div class="col-sm-6 priceContent">
                        <span>
                            <input class="invisible-input" type="text" name="" value="" id="total_setting_price" disabled>
                            <input type="hidden" name="" id="total_setting_hidden">
                        </span>

                    </div>
                </div>


            </div>
        </div>


        <div class="buttons clearfix">
            <div class="floatButtons">
                <button class="btn btn-outline-danger" type="button" id="cancelSetting">Cancelar</button>
                <button class="btn btn-sm btn-primary" type="submit" id="addSetting">Guardar</button>
            </div>
        </div>
    </form>
</div>