<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1><i class="fas fa-file-alt"></i> Nueva factura </h1>
        </div>

    </div>
</div>


<div class="generalContainer">
    <div class="container">

        <div class="form-group row nofactura">
            <label for="" class="col-sm-1 text-right ">No.</label>
            <div class="col-sm-3">
                <input class="form-custom col-sm-5" type="text" name="" id="nofactura" value="" disabled>
            </div>
        </div>
    </div>

    <br> <br>

    <div class="container">
        <div class="row">

            <!-- Hiddens -->
            <input type="hidden" name="user_id" value="<?= $_SESSION['identity']->user_id ?>" id="user_id">
            <input type="hidden" name="" value="" id="customer_id">
            <input type="hidden" name="name" value="" id="customer">

            <div class="form-group col-md-6">
                <div class="form-group row">
                    <label for="" class="col-sm-2 text-right">Cliente</label>
                    <div class="col-sm-7">
                        <select class="form-custom search col-sm-10" name="" id="searchCustomer">
                            <option value="" selected></option>
                            <?php $customers = Help::showCustomers();
                            while ($customer = $customers->fetch_object()) : ?>
                                <option value="<?= $customer->customer_id ?>"><?= $customer->customer_name ?></option>
                            <?php endwhile; ?>
                        </select>
                        <a class="ml-1 mt-1" data-toggle="modal" data-target="#modalCustomer"><i class="fas fa-plus-circle"></i></a>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 text-right ">RNC</label>
                    <div class="col-sm-7">
                        <input class="form-custom col-sm-10" type="text" name="rnc" id="rnc" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 text-right">Télefono</label>
                    <div class="col-sm-7">
                        <input class="form-custom col-sm-10" type="number" name="telephone_1" id="telephone1" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 text-right">Vendedor </label>
                    <div class="col-sm-7">
                        <input class="form-custom col-sm-10" type="text" name="" value="<?= $_SESSION['identity']->name ?>" id="" disabled>

                    </div>
                </div>


            </div>


            <div class="form-group col-md-6">

                <div class="form-group row">
                    <label for="" class="col-sm-3 text-right">Fecha</label>
                    <div class="col-sm-7">
                        <input type="date" name="created_at" class="form-custom col-sm-10" id="date" value="<?php date_default_timezone_set('America/Los_Angeles');
                                                                                                            echo date('Y-m-d'); ?>">
                        <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="created_at" class="col-sm-3 text-right">Expiración</label>
                    <div class="col-sm-7">
                        <input type="date" name="expiration" class="form-custom col-sm-10" id="invoice_expiration">
                        <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 text-right">Pago</label>
                    <div class="col-sm-7">
                        <select class="form-custom  col-sm-10" name="" id="payment_method">

                            <?php $payments = Help::showPayments_methods();
                            while ($payment = $payments->fetch_object()) : ?>
                                <option value="<?= $payment->payment_id ?>"><?= $payment->payment_name ?></option>
                            <?php endwhile; ?>

                        </select>
                        <a class=" mt-1" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-plus-circle"></i></a>
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
            <form>
                <tr>
                    <input type="hidden" name="product_id" value="" id="product_id">
                    <input type="hidden" name="invoice_id" value="" id="invoice_id">

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
                    <td> <a id="AgregarItem" href="#"><i class="far fa-plus-square"></i> Agregar</a></td>
                </tr>
            </form>
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

        <?php while ($info = $detalle->fetch_object()) : ?>

            <tbody id="rows">
                <tr>
                    <td><?= $info->product_code ?></td>
                    <td><?= $info->product_name ?></td>
                    <td><?= $info->total_quantity ?></td>
                    <td><?= number_format($info->price_out) ?></td>
                    <td><?= number_format($info->discount) ?></td>
                    <td><?= number_format($info->total_price) ?></td>
                    <td>
                        <a class="text-danger" onclick="eliminarItem('<?= $info->temp_detail_id ?>','<?= $info->product_id ?>','<?= $info->total_quantity ?>','<?= $info->quantity ?>')"><i class="far fa-trash-alt"></i></a>
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
            <button class="btn-sm btn-danger" type="button" id="cancelSale">Cancelar</button>

            <form action="<?= base_url ?>transaction/in" method="post" onsubmit="credit()">
            <input type="hidden" name="number" id="transactionNumber" disabled>
                <button class="btn btn-outline-dark ml-2" type="submit" id="addcredit">Guardar a crédito</button>
            </form>

            <button class="btn btn-outline-dark ml-2" type="button" id="printInvoice">Guardar e imprimir</button>

            <button class="btn-sm btn-primary ml-2 " type="button" id="processSale">Guardar</button>
        </div>
    </div>


</div> <!-- generalConntainer -->




<!-- Modal -->
<div class="modal fade" id="modalCustomer" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nuevo contacto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" onsubmit="event.preventDefault(); AddContact();">
                    <div class="row col-md-12">

                        <div class="form-group col-md-6 border-right">
                            <div class="form-group">
                                <label for="">Nombre<span class="text-danger">*</span></label>
                                <input class="form-control form-control-sm" type="text" name="name" id="customer_name_md" required>
                            </div>

                            <div class="form-group">
                                <label for="">RNC</label>
                                <input class="form-control form-control-sm" type="number" name="" id="rnc_md">
                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            <div class="form-group">
                                <label for="">Télefono 1</label>
                                <input class="form-control form-control-sm" type="number" name="" id="telephone1_md">
                            </div>

                            <div class="form-group">
                                <label for="">Télefono 2</label>
                                <input class="form-control form-control-sm" type="number" name="" id="telephone2_md">
                            </div>

                            <div class="form-group">
                                <label for="">Correo</label>
                                <input class="form-control form-control-sm" type="text" name="" id="email_md">
                            </div>

                        </div>
                    </div> <!-- Row col-md-12 -->

                    <div class="mt-1 modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-sm btn-primary" id="ad">Guardar</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>