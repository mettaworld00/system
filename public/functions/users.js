$(document).ready(function () {

    const SITE_URL = "http://localhost/sistem/";



    $('#login').on('click', (e)=>{
      e.preventDefault();

       $.ajax({
           type: "post",
           url: SITE_URL + "functions/users.php",
           data: {
               user: $('#userName').val(),
               password: $('#userPassword').val(),
               action: 'login'
           },
           success: function (res) {
                console.log(res)
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
                  console.log(res);
             }
         });
  
      })
  

}) // Ready