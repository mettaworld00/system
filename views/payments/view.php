<?php if (isset($_GET['id'])) {
    $invoice = Help::showTransactionIN($_GET['id']);
    while ($element = $invoice->fetch_object()) :
        if ($element->pending > 0) { ?>


            <form action="" onsubmit="event.preventDefault(); Addpayment();" id="form-payment">

                <div class="section-wrapper">
                    <div class="align-content clearfix">
                        <div class="float-left">
                            <h1>Nuevo ingreso <a href="#" class="example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a></h1>
                        </div>

                    </div>
                </div>


                <div class="generalContainer">

                    <div class="container">
                        <div class="row">

                            <!-- Hiddens -->
                            <input type="hidden" name="" value="<?= $element->customer_id ?>" id="debtor_id">
                            <input type="hidden" name="" value="<?= $element->invoice_id ?>" id="invoice_id">

                            <div class="form-group col-md-6">
                                <div class="form-group row">
                                    <label for="" class="col-sm-2 text-right">Cliente</label>
                                    <div class="col-sm-7">
                                        <input class="form-custom col-sm-10" type="text" value="<?= $element->customer_name ?>" name="" id="" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 text-right">Fecha</label>
                                    <div class="col-sm-7">
                                        <input type="date" name="created_at" class="form-custom col-sm-10" id="date" value="<?php date_default_timezone_set('America/Los_Angeles');
                                                                                                                            echo date('Y-m-d'); ?>">

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="created_at" class="col-sm-2 text-right">Expiración</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="" class="form-custom col-sm-10" value="<?= $element->expiration ?>" id="" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-2 text-right">Pago</label>
                                    <div class="col-sm-7">
                                        <select class="form-custom  col-sm-10" name="" id="payment_method" required>

                                            <?php $payments = Help::showPayments_methods();
                                            while ($payment = $payments->fetch_object()) : ?>
                                                <option value="<?= $payment->payment_method_id ?>"><?= $payment->payment_name ?></option>
                                            <?php endwhile; ?>

                                        </select>
                                    </div>
                                </div>


                            </div>


                            <div class="form-group col-md-6">

                                <div class="form-group row">
                                    <label for="" class="col-sm-3 text-right">Nota</label>
                                    <div class="col-sm-7">
                                        <textarea class="form-custom col-sm-10" name="" id="payment_note" cols="32" rows="5"></textarea>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div> <!-- Row col-md-12 -->
                    <br>


                </div> <!-- generalContainer -->


                <div class="generalContainer">
                    <table class="DetalleTemp">
                        <thead>
                            <th>Factura</th>
                            <th>Total</th>
                            <th>Cobrado</th>
                            <th>Por cobrar</th>
                            <th>Valor recibido</th>
                        </thead>

                        <tbody>

                            <tr>
                                <td> <input class="invisible-input" type="text" value="<?= $element->noinvoice ?>" id="" disabled> </td>
                                <td> <input class="invisible-input" type="text" value="<?= $symbol . ' ' . number_format($element->total_invoice, 2) ?>" id="" disabled> </td>
                                <td> <input class="invisible-input text-success" type="text" value="<?= $symbol . ' ' . number_format($element->money_received, 2) ?>" id="" disabled> </td>
                                <td> <input class="invisible-input text-danger" type="text" value="<?= $symbol . ' ' . number_format($element->pending, 2) ?>" id="" disabled> </td>
                                <td><input class="no-border" type="number" name="" id="received_value" required></td>
                            </tr>

                        </tbody>
                    </table> <br>

                    <div class="buttons clearfix">
                        <div class="floatButtons">
                            <button class="btn btn-sm btn-primary" type="submit" id="">Guardar</button>
                        </div>
                    </div>
                </div>

            </form>


<?php } 
    endwhile;
} else { echo "No hay nada"; }?>