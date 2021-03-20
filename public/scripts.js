$(document).ready(function () {

  // window.onload = localStorage.clear(); // limpiar localstorage al cargar

  /**
   *  Menú Accordeon
   * ------------------------------------
   */

  $(function () {
    var Accordion = function (el, multiple) {
      this.el = el || {};
      this.multiple = multiple || false;

      // Variables privadas
      var links = this.el.find('.link');
      // Evento
      links.on('click', {
        el: this.el,
        multiple: this.multiple
      }, this.dropdown)
    }

    Accordion.prototype.dropdown = function (e) {
      var $el = e.data.el;
      $this = $(this),
      $next = $this.next();

      $next.slideToggle();
      $this.parent().toggleClass('open');

      if (!e.data.multiple) {
        $el.find('.submenu').not($next).slideUp().parent().removeClass('open');
      };
    }

    var accordion = new Accordion($('#accordion'), false);
  });

  /**
 * Verificar la página actual
 --------------------------------------------*/

  $(function(){

    var pageURL = $(location).attr("pathname");
 
      
    if (pageURL == "/sistem/invoices/invoices" || pageURL == "/sistem/invoices/addpurchase" || pageURL == "/sistem/invoices/credits"){

        $('.dropdown-1 ul.submenu').css('display','block');
        $('.accordion .dropdown-1').addClass('open');

    } else if (pageURL == "/sistem/services/index" || pageURL == "/sistem/services/addinvoice"){

      $('.dropdown-2 ul.submenu').css('display','block');
      $('.accordion .dropdown-2').addClass('open');

    } else if (pageURL == "/sistem/product/index" || pageURL == "/sistem/product/add" || pageURL == "/sistem/product/edit" || pageURL == "/sistem/product/save"){
      
      $('.dropdown-3 ul.submenu').css('display','block');
      $('.accordion .dropdown-3').addClass('open');

    } else if (pageURL == "/sistem/contacts/index" || pageURL == "/sistem/contacts/add" || pageURL == "/sistem/contacts/save"){

      $('.dropdown-4 ul.submenu').css('display','block');
      $('.accordion .dropdown-4').addClass('open');

    }
     
  })


/**
 * Valores del detalle por Default
 ----------------------------------------------*/
 

  $('#price_out').val('0.00');
  $('#total_price').val('0.00');
  $('#stock').val('0');
  $('#quantity').val('0');
  $('#discount').val('0');
  $('#AgregarItem').hide();
  $('#AgregarCompra').hide();
  $('#description').val('-');
  $('#quantity').attr("disabled", true);
  $('#discount').attr("disabled", true);
  $('#total_price').attr("disabled", true);

  /**
   * Valores de la sección agregar producto
   ----------------------------------------------*/

  $('#inputMinCantidad').val(1);
  $('#inputCantidad').val(1);


  /**
   * Activar librerías JavaScript
  ------------------------------------- */

  $('#example').DataTable();
  $('.search').select2();

  /**
   * Bootstrap4 PopOvers
   -----------------------------------*/



  $(function () {
    $('.example-popover').popover({
      container: 'body'
    })
  })

  $(function () {
    $('[data-toggle="popover"]').popover()
  })


 $('.loader').hide(); // Loader 

   


}) // Exit ready;