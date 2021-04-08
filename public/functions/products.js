$(document).ready(function () {
  const SITE_URL = "http://localhost/sistem/";

  // Default
  $("#product_quantity").val("1");
  $("#min_quantity").val("1");
  $(".list").hide();



  // Activar lista de precios
  $(".price_list").on("click", (e) => {
    e.preventDefault();

    $(".list").slideToggle("fast");
  });

  /**
        * Precio mas impuesto
        -----------------------------------*/

  $("#tax").change(function () {
    var tax = $("#select2-tax-container").attr("title");

    if (tax != "Nínguno") {
      searchTax(tax); // Precio con Impuestos
    } else {
      clcFinalPrice(); // Precio sin Impuestos
    }
  });

  function searchTax(tax = "") {
    $.ajax({
      type: "post",
      url: SITE_URL + "functions/products.php",
      data: {
        action: "buscarImpuesto",
        tax: tax,
      },
      success: function (res) {
        var data = JSON.parse(res);

        var tax_value = data.tax_value / 100;
        clcFinalPrice(tax_value);
      },
    });
  }

  /**
        * Calcular precio del Item
        -----------------------------------------*/

  $("#precioTotal").val("0.00");

  $("#inputPrice_out").keyup(function (e) {
    e.preventDefault();

    clcFinalPrice();
  });

  function clcFinalPrice(tax = 0) {
    $(".price_list").slideDown();

    const format = new Intl.NumberFormat("en");

    var tax_selected = $("#select2-tax-container").attr("title");

    if (tax > 0) {
      var price_out = $("#inputPrice_out").val();

      if (price_out != "") {
        var taxNETO = price_out * tax;
        var product_price = parseInt(price_out) + parseInt(taxNETO);

        $("#FinalPrice_out").val(product_price);
        $("#precioTotal").val(format.format(product_price) + ".00");
        clcPrice_list(product_price);
      }
    } else if (tax_selected != "nínguno") {
      searchTax(tax_selected);
    } else {
      var price_out = $("#inputPrice_out").val();

      $("#FinalPrice_out").val(price_out);
      $("#precioTotal").val(format.format(price_out) + ".00");
      clcPrice_list(price_out);
    }
  }

  // Calcular lista de precios

  function clcPrice_list(price) {
    $("#price_list").change((e) => {
      e.preventDefault();

      var list_name = $("#price_list :selected").text();

      const format = new Intl.NumberFormat("en");
      var value = $("#price_list").val();

      if (value != 0) {
        var porcent = value / 100;
        var price_of_list = price * porcent;
        var final_priceList = price - price_of_list;
        $("#list_value").val(format.format(final_priceList));
      } else if (value == 0) {
        $("#list_value").val(format.format(price));
      }
    });
  }

  /**
        * Lista de precios
       ----------------------------------------------------------------------------------- */

  let ArrayPriceList = [];

  $(".addlist").on("click", (e) => {
    e.preventDefault();

    let data = {
      id: $("#price_list :selected").attr("list_id"),
      name: $("#price_list :selected").text(),
      value: $("#list_value").val(),
    };

    // Buscar coincidencia si existe en el localStorage
    FindAMatch(ArrayPriceList);

    function FindAMatch(arr) {
      if (arr.length < 1) {
        arr.push(data);
        createDB();
      } else {
        let found = arr.find((element) => element.name == data.name);

        if (found == undefined) {
          arr.push(data);
          createDB();
        }
      }
    }
  });

  function createDB() {
    localStorage.setItem("price_list", JSON.stringify(ArrayPriceList));
    showDB(); // Mostrar DB
  }

  let arrayLocalStorage;

  function showDB() {
    document.querySelector(".list_titles").innerHTML = ""; // Vaciar detalle

    if (localStorage.getItem("price_list")) {
      arrayLocalStorage = JSON.parse(localStorage.getItem("price_list"));
    }

    // Loop de los servicios en localStorage
    arrayLocalStorage.forEach((element, index) => {
      var listHTML =
        "<li>" + element.name + " - " + "$" + element.value + "</li>";
      $(".list_titles").append(listHTML);
    });
  }

  // Calcular el impuesto

  if ($("#tax").val() != null) {
    searchTax($("#select2-tax-container").attr("title"));
  }





}); // Ready


// Verificar código del producto

function verify_product_code() {

  var product_code = $("#product_code").val();

  $.ajax({
    type: "post",
    url: SITE_URL + "functions/products.php",
    data: {
      action: "verificar-codigo",
      product_code: product_code,
    },
    success: function (res) {
      console.log(res);
    },
  });

}


/**
 * Crear producto
 *------------------------------------------------*/

function addNewProduct(user_id) {

  $.ajax({
    type: "post",
    url: SITE_URL + "functions/products.php",
    data: {
      userID: user_id,
      name: $("#product_name").val(),
      product_code: $("#product_code").val(),
      price_out: $("#inputPrice_out").val(),
      price_in: $("#inputPrice_in").val(),
      quantity: $("#product_quantity").val(),
      min_quantity: $("#min_quantity").val(),
      expiration: $("#inputExpiration").val(),

      // Keys

      unit: $("#unit").val(),
      tax: $("#tax").val(),
      category: $("#category").val(),
      warehouse: $("#warehouse").val(),
      action: "agregarProducto",
    },
    beforeSend: function () {
      $(".loader").show();
    },
    success: function (res) {

      if (res != "match") {

        var length = $(".list_titles li").length;
        var list_length = length + 1;

        for (let index = 1; index < list_length; index++) {
          var price_list = JSON.parse(localStorage.getItem("price_list" + index));

          if (localStorage.getItem("price_list" + index)) {
            addPriceList(res, price_list.id);
          } else {
            console.log("no hay price list");
          }
        }

        localStorage.clear();

      } else {
        alertify.alert("<div class='error-info'><i class='text-danger fas fa-exclamation-circle'></i> El código del producto ya existe!</div>").set('basic', true);
      }


      $(".loader").hide();
    }
  });

  function addPriceList(product_id, list_id) {
    $.ajax({
      type: "post",
      url: SITE_URL + "functions/products.php",
      data: {
        list_id: list_id,
        product_id: product_id,
        action: "agregarPreciosAlProducto",
      },
      success: function (res) {
        console.log(res);
      },
    });
  }
}



// Actualizar producto

function updateProduct(productID) {

  $.ajax({
    type: "post",
    url: SITE_URL + "functions/products.php",
    data: {
      name: $("#product_name").val(),
      product_id: productID,
      product_code: $("#product_code").val(),
      price_out: $("#inputPrice_out").val(),
      price_in: $("#inputPrice_in").val(),
      quantity: $("#productQuantity").val(),
      min_quantity: $("#min_quantity").val(),
      expiration: $("#inputExpiration").val(),

      // Keys

      unit: $("#unit").val(),
      tax: $("#tax").val(),
      category: $("#category").val(),
      warehouse: $("#warehouse").val(),
      action: "actualizar-producto",
    },
    beforeSend: function () {
      $(".loader").show();
    },
    success: function (res) {

      console.log(res);

      if (res == "match") {

        alertify.alert("<div class='error-info'><i class='text-danger fas fa-exclamation-circle'></i> El código del producto ya existe!</div>").set('basic', true);

      } 

      $(".loader").hide();
    }

  })

}


// Desactivar producto

function disableProduct(product_id) {
  alertify.confirm(
    "<i class='text-warning fas fa-exclamation-circle'></i> Desactivar producto",
    "¿Desea desactivar este producto? ",
    function () {
      $.ajax({
        type: "post",
        url: SITE_URL + "functions/products.php",
        data: {
          productID: product_id,
          action: "desactivarProducto",
        },
        beforeSend: function () {
          $(".loader").show();
        },
        success: function (res) {
          $("#example").load(" #example");
          $(".loader").hide();
        },
      });
    },
    function () { }
  );
}

// Activar producto

function enableProduct(product_id) {
  alertify.confirm(
    "Activar producto",
    "¿Desea activar este producto? ",
    function () {
      $.ajax({
        type: "post",
        url: SITE_URL + "functions/products.php",
        data: {
          productID: product_id,
          action: "activarProducto",
        },
        beforeSend: function () {
          $(".loader").show();
        },
        success: function (res) {
          $("#example").load(" #example");
          $(".loader").hide();
        },
      });
    },
    function () { }
  );
}

// Eliminar producto

function deleteProduct(id) {
  var action = "eliminarProducto";

  alertify.confirm(
    "¿Estas seguro que deseas borrar este producto? ",
    function () {
      $.ajax({
        url: "http://localhost/sistem/functions/products.php",
        method: "post",
        data: {
          action: action,
          product_id: id,
        },
        success: function (res) {
          console.log(res);
          if (res == 1) {
            $(".table").load(location.href + " .table");

            alertify.success("Item eliminado");
          } else {
            alertify.error("No se ha podido eliminar este producto");
          }
        },
      });
    },
    function () {
      alertify.error("Cancelado");
    }
  );
}
