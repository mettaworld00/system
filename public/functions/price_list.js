$(document).ready(function(){

    const SITE_URL = "http://localhost/sistem/";

   $('#addList').on('click',(e)=>{

      var list_name = $('#list_name').val();
      var list_value = $('#list_value').val();
      var list_comment = $('#list_comment').val();

      $.ajax({
          type: "post",
          url: SITE_URL + "functions/price_list.php",
          data: {
              list_name: list_name,
              list_value: list_value,
              list_comment: list_comment,
              action: 'agregarLista'
          },
          success: function (res) {
              console.log(res)
          }
      });
   })
   

}) // Ready