<?php $invoice = Help::showInvoice($_GET['id']);
while ($element = $invoice->fetch_object()) : ?>


    <div class="section-wrapper">
        <div class="align-content clearfix">
            <div class="float-left">
                <h1><i class="fas fa-file-alt"></i> N° Factura <?= $element->noinvoice ?> </h1>
            </div>

        </div>
    </div>


    <div class="generalContainer">

        <div class="container">
            <div class="row">

                <!-- Hiddens -->
                <input type="hidden" name="user_id" value="<?= $element->user_id ?>" id="user_id">
                <input type="hidden" name="" value="" id="customer_id">
                <input type="hidden" name="name" value="" id="customer">

                <div class="form-group col-md-6">
                    <div class="form-group row">
                        <label for="" class="col-sm-2 text-right">Cliente</label>
                        <div class="col-sm-7">
                            <input class="form-custom col-sm-10" type="text" value="<?= $element->customer_name ?>" name="" id="" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 text-right ">RNC</label>
                        <div class="col-sm-7">
                        <input class="form-custom col-sm-10" type="text" value="<?= $element->rnc ?>" name="" id="" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 text-right">Télefono</label>
                        <div class="col-sm-7">
                        <input class="form-custom col-sm-10" type="text" value="<?= $element->telephone1 ?>" name="" id="" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-2 text-right">Vendedor </label>
                        <div class="col-sm-7">
                        <input class="form-custom col-sm-10" type="text" value="<?= $element->name ?>" name="" id="" disabled>

                        </div>
                    </div>


                </div>


                <div class="form-group col-md-6">

                    <div class="form-group row">
                        <label for="" class="col-sm-3 text-right">Fecha</label>
                        <div class="col-sm-7">
                            <input type="text" name="" class="form-custom col-sm-10" id="" value="<?= $element->date ?>" disabled>
                           
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="created_at" class="col-sm-3 text-right">Expiración</label>
                        <div class="col-sm-7">
                            <input type="text" name="" class="form-custom col-sm-10" value="<?= $element->expiration ?>" id="" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-sm-3 text-right">Pago</label>
                        <div class="col-sm-7">
                        <input type="text" name="" class="form-custom col-sm-10" value="<?= $element->payment_name ?>" id="" disabled>
                        </div>
                    </div>


                    <!-- <div class="form-group row">
                    <label for="" class="col-sm-3 text-right">Lista de precios </label>
                    <div class="col-sm-7">
                        <select name="" class="form-custom col-sm-10" id="">
                            <option value="0" selected>General</option>
                        </select>
                    </div>
                </div> -->
                </div>


            </div>
        </div> <!-- Row col-md-12 -->
        <br>


        <table class="DetalleTemp">
            <thead>
                <th>Código</th>
                <th>Descripción</th>
                <th>Stock</th>
                <th>Cant.</th>
                <th>Desc -$</th>
                <th>Impuestos</th>
                <th>Precio</th>
                <th>Importe</th>
                <th></th>
            </thead>

            <tbody>
            
                    <tr>
                        <input type="hidden" name="product_id" value="" id="product_id">
                        <input type="hidden" name="invoice_id" value="<?= $_GET['id']?>" id="invoice_id">

                        <td><input class="no-border" type="text" name="codigo" id="barcode"></td>
                        <td class="2">

                            <select name="" id="description" class="search">
                                <option value="" selected></option>
                                <?php $products = Help::showProducts();
                                while ($product = $products->fetch_object()) : ?>
                                    <option value="<?= $product->product_name ?>"><?= $product->product_name ?></option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                        <td> <input class="invisible-input" type="text" id="stock" disabled> </td>
                        <td><input class="no-border" type="text" name="" id="quantity" pattern="[0-9]" disabled></td>
                        <td> <input class="no-border" type="text" id="discount" disabled> </td>
                        <td><input class="no-border" type="text" id="tax_value" disabled></td>
                        <td> <input class="invisible-input" type="text" id="price_out" disabled> </td>
                        <td><input id="total_price" class="invisible-input" type="text" name="" disabled></td>
                        <td> <a id="addPurchase" href="#"><i class="far fa-plus-square"></i> Agregar</a></td>
                    </tr>
             
            </tbody>
        </table> <br>


        <table id="Detalle" class="DetalleTemp">
            <thead>
                <th>Código</th>
                <th>Descripción</th>
                <th>Cant</th>
                <th>Precio</th>
                <th>Desc -$</th>
                <th>Importe</th>
                <th></th>
            </thead>

            <?php $details = Help::showDetail($_GET['id']); while ($detail = $details->fetch_object()) : ?>

                <tbody id="detail_row">
                    <tr>
                        <td><?= $detail->product_code ?></td>
                        <td><?= $detail->product_name ?></td>
                        <td><?= $detail->total_quantity ?></td>
                        <td><?= number_format($detail->price_out) ?></td>
                        <td><?= number_format($detail->discount) ?></td>
                        <td><?= number_format($detail->total_price) ?></td>
                        <td>
                            <a class="text-danger" onclick="deleteInvoiceDetail('<?= $detail->invoice_detail_id ?>','<?= $detail->invoice_id ?>','<?= $detail->product_id ?>','<?= $detail->total_quantity ?>','<?= $detail->stock ?>')"><i class="far fa-trash-alt"></i></a>
                        </td>
                    </tr>
                </tbody>
            <?php endwhile; ?>
        </table>




        <br>
        <br>
        <br>
        <br>
        <br>



        <div class="totalContainer clearfix ">
            <div class="floatContainer" id="ContainerTotalInvoice">

            </div>
        </div>

        <br><br>

        <div class="buttons clearfix">
            <div class="floatButtons">
                <button class="btn-sm btn-success ml-2" type="button" id="printInvoice">imprimir</button>
            </div>
        </div>


    </div> <!-- generalConntainer -->

<?php endwhile; ?>