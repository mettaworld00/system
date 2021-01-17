<div class="section-wrapper">
    <div class="align-content clearfix">
        <h1><i class="fas fa-box"></i> Información</h1>
    </div>
</div>

<form action="<?= base_url ?>product/save" method="post" id="formAddProduct">
    <div class="generalContainer">

        <div class="row col-md-12">

            <div class="form-group col-md-3 border-right">
                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Nombre</label>
                    <input class="form-custom col-sm-12 input-border-botton" type="text" name="name" id="" placeholder="Vacío" disabled>
                </div>

                <label class="form-check-label" for="">Precio</label> 
                <div class="form-group mb-3">
                    <input type="number" name="" class="form-custom col-sm-12 input-border-botton" placeholder="Vacío" disabled>
                </div>

                <label class="form-check-label" for="">Lista de precio </label> 
                <div class="form-group mb-3">
                    <input type="number" name="" class="form-custom col-sm-12 input-border-botton" placeholder="Vacío" disabled>
                </div>

            </div>


            <div class="form-group col-md-2 border-right">
                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Código de producto </label> 
                    <input class="form-custom col-sm-12 input-border-botton" type="text" name="" placeholder="Vacío" disabled>
                </div>

                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Cuentas contables </label> 
                    <input class="input-border-botton form-custom" type="text" placeholder="Vacío" disabled>
                </div>

                <div class="form-group mb-3">
                    <label class="form-check-label" for="">Impuesto %</label>
                     <input class="form-custom input-border-botton" type="text" placeholder="Vacío" disabled>
                </div>


            </div> <!-- form-group col-md-3 -->

            <div class="form-group col-md-4">


                <div class="form-group">
                    <label for="">Precio total</label>
                    <div class="productPrice">

                        <span>RD$</span><input type="text" class="hidde" id="precioTotal" disabled>
                    </div>
                </div>
            </div>

        </div> <!-- Row col-md-12 -->

        <div class="col-md-11 mt-4" id="">

            <div class="form-group row">
                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Unidad de medida</label>
                    <input class="input-border-botton form-custom" type="text" name="" id="" placeholder="Vacío" disabled>
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Costo unidad</label> 
                    <input type="number" name="price_in" class="form-custom col-sm-12 input-border-botton" placeholder="Vacío" disabled>
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Total de unidades</label> 
                    <input class="form-custom col-sm-12 input-border-botton" type="number" name="quantity" placeholder="Vacío"  required>
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Miníma unidad </label> 
                    <input class="form-custom col-sm-12 input-border-botton" type="number" name="inventary_min"  placeholder="Vacío" disabled>
                </div>

                <div class="form-group col-sm-2">
                    <label class="form-check-label" for="">Almacen </label> 
                  <input class="input-border-botton form-custom" type="text" name="" id="" placeholder="Vacío" disabled>
                </div>
            </div>
        </div>



    </div> <!-- GeneralContainer -->

    <div class="buttons clearfix">
        <div class="floatButtons">
            <a class="btn btn-danger" href="<?= base_url ?>product/index">Cancelar</a>
            <a class="btn btn-secondary" href="<?= base_url ?>product/add" id="createNewProduct">Guardar y crear nueva</a>
            <input class="btn btn-primary " type="submit" value="Guardar">
        </div>
    </div>
</form>