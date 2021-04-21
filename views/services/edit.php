<?php $invoice = Help::showServicesID($_GET['id']);
while ($element = $invoice->fetch_object()) : ?>

    <div class="section-wrapper">
        <div class="align-content clearfix">
            <div class="float-left">
                <h1></h1>
            </div>

        </div>
    </div>


    <div class="generalContainer">
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
    


    </div> <!-- generalConntainer -->

<?php endwhile; ?>