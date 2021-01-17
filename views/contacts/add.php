<div class="section-wrapper">
    <div class="align-content clearfix">
        <h1><i class="fas fa-id-card-alt"></i> Nuevo contacto</h1>
    </div>
</div>


<form action="<?= base_url ?>customers/save" method="post" id="formAddCustomers">

    <div class="generalContainer">
        <div class="row col-md-12">

            <div class="form-group col-md-5">

                <div class="form-group row">
                    <label for="" class="col-sm-3 text-right">Nombre </label>
                    <div class="col-md-8">
                        <input class="form-custom" type="text" name="name" id="nameContact" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="" class="col-sm-3 text-right">RNC</label>
                    <div class="col-md-8">
                        <input class="form-custom" type="text" name="rnc" id="rncContact">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-3 text-right">Dirección</label>
                    <div class="col-md-8">

                        <select name="" id="" class="search form-custom ">
                            <option value=""></option>
                        </select>
                        <input class="form-custom mb-1 mt-1" type="text" name="" placeholder="Calle" id="">
                        <input class="form-custom mb-1" type="text" name="" placeholder="Provincia" id="">
                        <input class="form-custom mb-1" type="text" name="" placeholder="Código postal" id="">
                    </div>
                </div>

            </div>

            <div class="form-group col-md-5">

                <div class="form-group row">
                    <label for="" class="col-sm-4 text-right">Email </label>
                    <div class="col-md-8">
                        <input class="form-custom" type="email" name="" id="emailContact">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 text-right">Télefono 1 </label>
                    <div class="col-md-8">
                        <input class="form-custom" type="number" name="" id="telContact1">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-sm-4 text-right">Télefono 2 </label>
                    <div class="col-md-8">
                        <input class="form-custom" type="number" name="" id="telContact2">
                    </div>
                </div>

            </div>

        </div> <!-- Row col-md-12 -->


        <div class="buttons clearfix">
            <div class="floatButtons">
                <button class="btn btn-sm btn-primary" type="button" id="addContact">Guardar</button>

            </div>
        </div>
    </div>

</form>