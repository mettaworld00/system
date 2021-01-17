<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1>Nuevo Impuestos</h1>
        </div>


    </div>
    <p class="title-info">Utiliza los impuestos para agregar una carga fiscal sobre el consumo, financiado por el consumidor como impuesto regresivo</p>
</div>



<div class="generalContainer-medium">
    <div class="container row">

    <input type="hidden" name="user_id" value="<?= $_SESSION['identity']->user_id?>" id="user_id">

        <div class="form-group col-md-8">
            <div class="form-group d-flex">
                <label for="" class="col-sm-3 text-right ">Nombre</label>
                <input class="form-custom col-sm-12" type="text" name="" id="tax_name" required>
                <a href="#" class=" ml-1 example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a>
            </div>

            <div class="form-group mt-3 d-flex">
                <label for="" class="col-sm-4 text-right ">Porcentaje</label>
                    <input class="form-custom col-sm-5" type="number" name="" id="tax_value" required>
                    <span class="ml-1">%</span>
                   
            </div>

            <div class="form-group mt-3 d-flex">
                <label for="" class="col-sm-4 text-right ">Observación</label>
                <textarea class="form-control" name="" id="tax_comment" cols="23" rows="5"></textarea>
            </div>
        </div>

    </div>
    <p class="info-sm mt-2">Los campos marcados con * son obligatorios</p>

    <div class="buttons clearfix">
        <div class="floatButtons">
            <button class="btn btn-primary " type="button" id="addTax">Guardar</button>
        </div>
    </div>
</div>