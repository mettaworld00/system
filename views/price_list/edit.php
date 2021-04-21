<?php $list = Help::showPrice_listID($_GET['id']); while($element = $list->fetch_object()): ?>

<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1><i class="far fa-edit"></i> Editar precio</h1>
        </div>


    </div>
    <p class="title-info">Utiliza listas de precios si deseas manejar diferentes precios sobre tus items.</p>
</div>


<div class="generalContainer-medium">
    <form action="" onsubmit="event.preventDefault(); UpdateList('<?= $_GET['id']; ?>');">
        <div class="container row">

            <div class="form-group col-md-8">
                <div class="form-group d-flex">
                    <label for="" class="col-sm-3 text-right ">Nombre<span class="text-danger">*</span></label>
                    <input class="form-custom col-sm-12" type="text" value="<?= $element->list_name ?>" name="" id="list_name" required>
                    <a href="#" class=" ml-1 example-popover" data-toggle="popover" title="Popover title" data-content="And here's some amazing content. It's very engaging. Right?"><i class="far fa-question-circle"></i></a>
                </div>


                <div class="form-group mt-3 d-flex">
                    <label for="" class="col-sm-4 text-right ">Porcentaje<span class="text-danger">*</span></label>
                    <input class="form-custom col-sm-5" type="number" value="<?= $element->list_value ?>" name="" id="list_value" required>
                    <span class="ml-1">%</span>

                </div>

                <div class="form-group mt-3 d-flex">
                    <label for="" class="col-sm-4 text-right ">Observación</label>
                    <textarea class="form-control" name="" id="list_comment" cols="23" rows="5"><?= $element->observation ?></textarea>
                </div>
            </div>

        </div>
        <p class="info-sm mt-2">Los campos marcados con <span class="text-danger">*</span> son obligatorios</p>

        <div class="buttons clearfix">
            <div class="floatButtons">
                <button class="btn btn-primary " type="submit" id="">Guardar</button>
            </div>
        </div>
    </form>
</div>

<?php endwhile; ?>