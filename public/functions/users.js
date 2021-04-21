$(document).ready(function () {

    const SITE_URL = "http://localhost/sistem/";


    // Iniciar sesión

    $('.load').hide();

    $('#login').on('submit', (e)=>{
      e.preventDefault();

       $.ajax({
           type: "post",
           url: SITE_URL + "functions/users.php",
           data: {
               user: $('#userName').val(),
               password: $('#userPassword').val(),
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
                    $('#btn-txt').show();
                }
           }
       });

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