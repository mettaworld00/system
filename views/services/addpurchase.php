<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1><i class="fas fa-file-alt"></i> Nueva factura de servicio</h1>
        </div>

    </div>
</div>

<div class="generalContainer">

    <div class="container">

        <div class="form-group row nofactura">
            <label for="" class="col-sm-1 text-right ">No.</label>
            <div class="col-sm-3">
                <input class="form-custom col-sm-5" type="text" name="" id="noService" value="" disabled>
            </div>
        </div>
    </div>

    <br> <br>
  

    <div class="container ">
        <div class="row">

            <!-- Hiddens -->
            <input type="hidden" name="user_id" value="<?= $_SESSION['identity']->user_id?>" id="user_id">
            <input type="hidden" name="" value="" id="customer_id">
            <input type="hidden" name="name" value="" id="customer">
            <input type="hidden" name="purchase" value="" id="purchase">

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
                        <input class="form-custom col-sm-10 " type="text" name="rnc" id="rnc" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 text-right">Télefono</label>
                    <div class="col-sm-7">
                        <input class="form-custom col-sm-10 " type="number" name="telephone_1" id="telephone1" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-2 text-right">Vendedor </label>
                    <div class="col-sm-7">
                        <input class="form-custom col-sm-10" type="text" name="" value="<?= $_SESSION['identity']->name?>" id="" disabled>

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

            </div>

        </div>
    </div> <!-- Row col-md-12 -->
    <br>

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

                    <td>
                        <select class="search col-md-12" name="" id="service_description">
                            <option value="" selected>Seleccionar</option>
                            <?php $services = Help::showServices();
                            while ($element = $services->fetch_object()) : ?>
                                <option value="<?= $element->service_id ?>"><?= $element->service_name ?></option>
                            <?php endwhile; ?>
                        </select>
                        <a class="ml-1 mt-1" data-toggle="modal" data-target="#modalService"><i class="fas fa-plus-circle"></i></a>
                    </td>
                    <td><input class="invisible-input" type="number" id="service_quantity" value="0" disabled></td>
                    <td><input class="invisible-input" type="text" id="service_price" value="0.00" disabled></td>
                    <td> <input class="no-border" type="text" id="service_discount" disabled> </td>
                    <td><input id="totalServicePrice" class="invisible-input" type="text" name="" disabled></td>
                    <td> <a id="addService" href="#"><i class="far fa-plus-square"></i> Agregar</a></td>
                </tr>
        </tbody>
    </table> <br>


    <table id="Detalle_service" class="DetalleTemp">
        <thead>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Desc -$</th>
            <th>Importe</th>
            <th></th>
        </thead>


        <tbody id="rows_services">

        </tbody>
    </table>



    <br>
    <br>
    <br>
    <br>
    <br>



    <div class="totalContainer clearfix ">
        <div class="floatContainer">
            <div class="row col-md-12">
                <div class="col-sm-6 priceContent">
                    <span class="text-right">Subtotal</span>
                    <span class="text-right">-Desc.</span>

                </div>

                <div class="col-sm-6 priceContent">
                    <input class="invisible-input text-left" type="text" name="" value="" id="total_service_subtotal" disabled>
                    <input class="invisible-input text-left" type="text" name="" value="" id="total_service_discount" disabled>

                </div>
            </div>

            <div class="row col-md-12  finalTotalContent">
                <div class="col-sm-6 priceContent">
                    <span class="text-right">Total</span>
                </div>

                <div class="col-sm-6 priceContent">
                    <input class="invisible-input text-left" type="text" name="" value="" id="total_service" disabled>
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <div class="buttons clearfix">
        <div class="floatButtons">
            <button class="btn btn-outline-danger" type="button" id="cancelService">Cancelar</button>
            <button class="btn btn-primary " type="button" id="processService">Guardar</button>
        </div>
    </div>


</div> <!-- generalConntainer -->






<!-- Modal -->
<div class="modal fade" id="modalService" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nuevo servicio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="" onsubmit="event.preventDefault(); AddService();">

                    <div class="form-group ">
                        <div class="form-group">
                            <label for="">Nombre<span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm" type="text" name="name" id="name_service_md" value="" required>
                        </div>

                        <div class="form-group">
                            <label for="">Precio<span class="text-danger">*</span></label>
                            <input class="form-control form-control-sm" type="text" name="" id="price_service_md" required>
                        </div>

                        <div class="form-group">
                            <label for="">Observación</label>
                            <textarea class="form-control form-control-sm" name="" id="serviceDescription" cols="30" rows="5"></textarea>
                        </div>

                    </div>

                    <div class="mt-1 modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary ml-2" id="addService">Guardar</button>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>


<!-- Modal contact -->


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