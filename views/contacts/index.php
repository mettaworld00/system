<div class="section-wrapper">
    <div class="align-content clearfix">
        <div class="float-left">
            <h1> Clientes</h1>
        </div>


        <div class="float-right">
            <button class="btn btn-sm btn-success"><i class="fas fa-file-csv"></i> Excel</button>
            <!-- Button customer modal -->
            <a class="btn btn-sm btn-secondary" href="<?=base_url?>contacts/add">Nuevo contacto</a>
        </div>
    </div>
</div>


<div class="generalContainer">
    <table id="example" class="table-custom table ">
        <thead>
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>RNC</th>
                <th>Télefono 1</th>
                <th>Télefono 2</th>
                <th>Acciones</th>
            </tr>
        </thead>



        <tbody>
            <?php while ($customer = $customers->fetch_object()) : ?>
                <tr>
                    <td><?= $customer->customer_id ?></td>
                    <td><?= $customer->customer_name ?></td>
                    <td><?= $customer->rnc ?></td>
                    <td><?= $customer->telephone1 ?></td>
                    <td><?= $customer->telephone2 ?></td>
                    <td>

                        <a href="<?= base_url ?>product/view&id=<?= $product->product_id ?>">
                            <span class="action-view"><i class="fas fa-eye"></i></span>
                        </a>

                        <span onclick="" class="action-delete"><i class="fas fa-trash-alt"></i></span>

                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

</div>


