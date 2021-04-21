$(document).ready(function () {

    const SITE_URL = "http://localhost/sistem/";

    $('.load').hide();
    $('.missing-key').hide();


    // Iniciar sesión

    $('#login').on('submit', (e)=>{
      e.preventDefault();

      var str = $('#userName').val();
      var position_verify = str.indexOf('@');

      if (position_verify != -1) {

        var position = position_verify + 1;
        var keyword = str.substr(position)

        var username = str.replace('@'+keyword,'');
      
        $.ajax({
            type: "post",
            url: SITE_URL + "functions/users.php",
            data: {
                user: username,
                password: $('#userPassword').val(),
                key: keyword,
                action: 'login'
            },
            beforeSend: function () {
                $('#btn-txt').hide();
                $('.load').show();
            },
            success: function (res) {
            
                 if (res == "approved") {
                     location.href=SITE_URL+"/home/index";
                 } else {
                     $('.i').css('color','red');
                     $('.i').css('transition','0.4s all ease');
                     $('.load').hide();
                     $('.missing-key').hide();
                     $('#btn-txt').show();
                 }
            }
        });

      } else {
         $('.missing-key').show();
      }
      

      

    })

    // Cerrar sesión
    
    $('#logout').on('click', (e)=>{
        e.preventDefault();
  
         $.ajax({
             type: "post",
             url: SITE_URL + "functions/users.php",
             data: {
                 action: 'logout'
             },
             success: function (res) {
                
                if (res == "ready") {
                    location.reload();
                }
             }
         });
  
      })
  

}) // Ready