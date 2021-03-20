<?php $invoice = Help::showServiceInvoice($_GET['id']);
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

        <?php if ($element->status_name == 'Por cobrar') : ?>
        <table class="DetalleTemp">
            <thead>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Desc -$</th>
                <th>Importe</th>
                <th></th>
            </thead>

            <tbody>
            
                    <tr>
                        <input type="hidden" name="service_id" value="" id="service_id">
                        <input type="hidden" name="invoice_id" value="<?= $element->service_invoice_id?>" id="invoice_id">

                        <td>
                        <select class="search col-md-12" name="" id="service_description">
                            <option value="" selected>Seleccionar</option>
                            <?php $services = Help::showServices();
                            while ($service = $services->fetch_object()) : ?>
                                <option value="<?= $service->service_id ?>"><?= $service->service_name ?></option>
                            <?php endwhile; ?>
                        </select>
                        <a class="ml-1 mt-1" data-toggle="modal" data-target="#modalService"><i class="fas fa-plus-circle"></i></a>
                    </td>
                    <td><input class="invisible-input" type="number" id="service_quantity" value="0" disabled></td>
                    <td><input class="invisible-input" type="text" id="service_price" value="0.00" disabled></td>
                    <td> <input class="no-border" type="text" id="service_discount" disabled> </td>
                    <td><input id="totalServicePrice" class="invisible-input" type="text" name="" disabled></td>
                    <td> <a id="addServiceToInvoice" href="#"><i class="far fa-plus-square"></i> Agregar</a></td>
                    </tr>
             
            </tbody>
        </table> <br>
<?php endif; ?>

        <table id="Detalle" class="DetalleTemp">
            <thead>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Desc -$</th>
                <th>Importe</th>
                <th></th>
            </thead>

            <?php $details = Help::showServiceDetail($_GET['id']); while ($detail = $details->fetch_object()) : ?>

                <tbody id="service_detail_row">
                    <tr>
                        <td><?= $detail->service_name ?></td>
                        <td><?= $detail->total_quantity ?></td>
                        <td><?= number_format($detail->price) ?></td>
                        <td><?= number_format($detail->discount) ?></td>
                        <td><?= number_format($detail->total_price) ?></td>
                        <td>
                            <span class="action-delete <?php if ($element->status_name != 'Por cobrar') { ?> action-disable  <?php } ?>" 
                            <?php if ($element->status_name == 'Por cobrar') { ?> onclick="deleteInvoiceDetail('<?= $detail->service_detail_id ?>','<?= $element->service_invoice_id ?>')" <?php } ?>>
                            <i class="far fa-trash-alt"></i>
                            </span>
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