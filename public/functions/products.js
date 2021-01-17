   $(document).ready(function () {

       const SITE_URL = "http://localhost/sistem/";


       $('#product_quantity').val('1');

       //    $('#inventoryItem').hide();
       $('.list').hide();

       //    $('#inventoryCheck').change((e) => {
       //        e.preventDefault();

       //        $('#inventoryItem').slideToggle('fast');
       //    })


       // Lista de precios
       $('.price_list').hide();

       $('.price_list').on('click', (e) => {
           e.preventDefault();

           $('.list').slideToggle('fast');
       })

       /**
        * Precio mas impuesto
        -----------------------------------*/

       $('#tax').change(function () {

           var tax = $('#select2-tax-container').attr('title');

           if (tax != 'Nínguno') {

               searchTax(tax); // Precio con Impuestos

           } else {

               clcFinalPrice(); // Precio sin Impuestos

           }

       })

       function searchTax(tax = '') {

           $.ajax({
               type: "post",
               url: SITE_URL + "functions/products.php",
               data: {
                   action: 'buscarImpuesto',
                   tax: tax
               },
               success: function (res) {

                   var data = JSON.parse(res);

                   var tax_value = data.tax_value / 100;
                   clcFinalPrice(tax_value);

               }
           });


       }

       /**
        * Calcular precio del Item
        -----------------------------------------*/

       $('#precioTotal').val('0.00')

       $('#inputPrice_out').keyup(function (e) {
           e.preventDefault();

           clcFinalPrice();

       })

       function clcFinalPrice(tax = 0) {

           //    $('.price_list').slideDown();

           const format = new Intl.NumberFormat('en');

           var tax_selected = $('#select2-tax-container').attr('title');

           if (tax > 0) {

               var price_out = $('#inputPrice_out').val();

               if (price_out != '') {

                   var taxNETO = price_out * tax;
                   var product_price = parseInt(price_out) + parseInt(taxNETO);

                   $('#FinalPrice_out').val(product_price);
                   $('#precioTotal').val(format.format(product_price) + '.00');
                  // clcPrice_list(product_price);

               }


           } else if (tax_selected != 'nínguno') {

               searchTax(tax_selected);

           } else {

               var price_out = $('#inputPrice_out').val();

               $('#FinalPrice_out').val(price_out);
               $('#precioTotal').val(format.format(price_out) + '.00');
              // clcPrice_list(price_out);

           }




       }


       // Calcular lista de precios

       function clcPrice_list(price) {


           $('#price_list').change((e) => {
               e.preventDefault();

               var list_name = $('#price_list :selected').text();


               const format = new Intl.NumberFormat('en');
               var value = $('#price_list').val();

               if (value != 0) {

                   var porcent = value / 100;
                   var price_of_list = (price * porcent);
                   var final_priceList = price - price_of_list;
                   $('#list_value').val(format.format(final_priceList));

               } else if (value == 0) {

                   $('#list_value').val(format.format(price));

               }


           });

       }

       // Agregar lista a producto

       $('.addlist').on('click', (e) => {
           e.preventDefault();

           var list_name = $('#price_list :selected').text(); // Nombre
           var list_id = $('#price_list :selected').attr('list_id'); // Id
           var list_value = $('#list_value').val(); // Valor final


           addlistToLocalStorage(list_id, list_name, list_value);
       })

       function addlistToLocalStorage(id, name, value) {

           let price_list = {
               id: id,
               name: name,
               value: value
           };

           if (localStorage.getItem('price_list1')) {



               var length = $('.list_titles li').length;
               var list_length = length + 1;

               localStorage.setItem("price_list" + list_length, JSON.stringify(price_list));
               addListTitles(list_length);

           } else {

               localStorage.setItem("price_list1", JSON.stringify(price_list));
               addListTitles(1);

           }


           // Agregar

           function addListTitles(id) {

               var listData = localStorage.getItem("price_list" + id);
               var data = JSON.parse(listData); // Json
               // console.log(JSON.parse(listData));

               var listHTML = '<li>' + data.name + ' - ' + '$' + data.value + '</li>';
               $('.list_titles').append(listHTML);

           }




       }



       /**
        * Crear producto
       ------------------------------------------------*/

       $('#createProduct').on('click', (e) => {
           e.preventDefault();

           let data = {

               // Info Product

               userID: $('#user_id').val(),
               name: $('#product_name').val(),
               product_code: $('#product_code').val(),
               price_out: $('#inputPrice_out').val(),
               price_in: $('#inputPrice_in').val(),
               quantity: $('#product_quantity').val(),
               min_quantity: $('#min_quantity').val(),
               expiration: $('#inputExpiration').val(),

               // Keys

               unit: $('#unit').val(),
               tax: $('#tax').val(),
               category: $('#category').val(),
               warehouse: $('#warehouse').val()
           }


           addNewProduct(data);

       })

       function addNewProduct(data) {

           $.ajax({
               type: "post",
               url: SITE_URL + "functions/products.php",
               data: {
                   userID: data.userID,
                   name: data.name,
                   product_code: data.product_code,
                   price_out: data.price_out,
                   price_in: data.price_in,
                   quantity: data.quantity,
                   min_quantity: data.min_quantity,
                   expiration: data.expiration,
                   tax: data.tax,
                   unit: data.unit,
                   category: data.category,
                   warehouse: data.warehouse,
                   action: 'agregarProducto'
               },
               success: function (res) {
                   console.log(res)

                   var length = $('.list_titles li').length;
                   var list_length = length + 1;

                   for (let index = 1; index < list_length; index++) {

                       var price_list = JSON.parse(localStorage.getItem('price_list' + index));

                       if (localStorage.getItem('price_list' + index)) {

                           addPriceList(res, price_list.id);


                       } else {
                           console.log("no hay price list");
                       }

                   }

                   localStorage.clear();
               }
           });

           function addPriceList(product_id, list_id) {

               $.ajax({
                   type: "post",
                   url: SITE_URL + "functions/products.php",
                   data: {
                       list_id: list_id,
                       product_id: product_id,
                       action: 'agregarPreciosAlProducto'

                   },
                   success: function (res) {
                       console.log(res)
                   }
               });
           }


       }

     /**
      * Actualizar producto
     ------------------------------------------- */
    if($('#tax').val() != null) { searchTax($('#select2-tax-container').attr('title')) }; // Calcular el impuesto
     

     $('#updateProduct').on('click',(e)=>{
         e.preventDefault();

        $.ajax({
            type: "post",
            url: SITE_URL + "functions/products.php",
            data: {
                product_id: $('#productId').val(),
                name: $('#product_name').val(),
                product_code: $('#product_code').val(),
                price_out: $('#inputPrice_out').val(),
                price_in: $('#inputPrice_in').val(),
                quantity: $('#productQuantity').val(),
                min_quantity: $('#min_quantity').val(),
                unit: $('#unit').val(),
                tax: $('#tax').val(),
                category: $('#category').val(),
                warehouse: $('#warehouse').val(),
                action: 'actualizarProducto'
            },
            success: function (res) {
                console.log(res)
            }
        });

       
     })




   }) // Ready










   // botón de guardar y crear nuevo 

   $('#createNewProduct').on('click', (e) => {
       e.preventDefault();

       var data = $('#formAddProduct').serialize();

       crearNuevoProducto(data);
   })

   function crearNuevoProducto(data) {

       $.ajax({
           type: "post",
           url: "http://localhost/sistem/product/save",
           data: data,
           success: function (response) {
               $('input[type="text"]').val('');
               $('input[type="number"]').val('');
               $('textarea').val('');
           }
       });
   }

   // Eliminar producto

   function deleteProduct(id) {

       var action = "eliminarProducto";

       alertify.confirm("¿Estas seguro que deseas borrar este producto? ",
           function () {

               $.ajax({
                   url: "http://localhost/sistem/functions/products.php",
                   method: "post",
                   data: {
                       action: action,
                       product_id: id
                   },
                   success: function (res) {
                       console.log(res);
                       if (res == 1) {

                           $('.table').load(location.href + " .table");


                           alertify.success('Item eliminado');
                       } else {
                           alertify.error('No se ha podido eliminar este producto');
                       }

                   }
               });

           },
           function () {
               alertify.error('Cancelado');
           });
   }