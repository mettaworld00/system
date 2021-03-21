$(document).ready(function () {
  const SITE_URL = "http://localhost/sistem/";

  /**
   * Gráfico de ventas de la semana
   ---------------------------------------------*/

  var SalesOfWeek = document.querySelector("#SalesOfWeek");

  if (SalesOfWeek != null) {
    $.ajax({
      type: "post",
      url: SITE_URL + "functions/home.php",
      data: {
        action: "ventaSemanal",
      },
      success: function (res) {
        
        if (res != '') {

         var data = JSON.parse(res);
         salesOfTheWeek(data);

        }
      },
    });
  }

  function salesOfTheWeek(data) {
    var ctx = document.getElementById("SalesOfWeek").getContext("2d");

    let labels = [];
    let datos = [];

    // Loop
    for (let index = 0; index < data.length; index++) {
      labels.push(data[index][1]);
      datos.push(data[index][0]);
    }

    var SalesOfWeek = new Chart(ctx, {
      type: "bar",
      data: {
        labels: labels,
        datasets: [
          {
            label: "Ventas - 7 días",
            data: datos,
            backgroundColor: [
              "rgba(255, 99, 132, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 206, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
              "rgba(255, 99, 132, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 206, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero: true,
              },
            },
          ],
        },
      },
    }); // Chart
  } // Function


/**
   * Gráfico de ventas de mensuales
   ---------------------------------------------*/

   var SalesOfMonth = document.querySelector("#SalesOfMonth");

   if (SalesOfMonth != null) {
     $.ajax({
       type: "post",
       url: SITE_URL + "functions/home.php",
       data: {
         action: "ventaMensual",
       },
       success: function (res) {
         
         if (res != '') {
 
          var data = JSON.parse(res);
          salesOfTheMonth(data);
 
         }
       },
     });
   }
 
   function salesOfTheMonth(data) {
     var ctx = document.getElementById("SalesOfMonth").getContext("2d");
 
     let labels = [];
     let datos = [];
 
     // Loop
     for (let index = 0; index < data.length; index++) {
       labels.push(data[index][1]);
       datos.push(data[index][0]);
     }
 
     var SalesOfWeek = new Chart(ctx, {
       type: "bar",
       data: {
         labels: labels,
         datasets: [
           {
             label: "Ventas - 12 meses",
             data: datos,
             backgroundColor: [
               "rgba(255, 99, 132, 0.2)",
               "rgba(54, 162, 235, 0.2)",
               "rgba(255, 206, 86, 0.2)",
               "rgba(75, 192, 192, 0.2)",
               "rgba(153, 102, 255, 0.2)",
               "rgba(255, 159, 64, 0.2)",
             ],
             borderColor: [
               "rgba(255, 99, 132, 1)",
               "rgba(54, 162, 235, 1)",
               "rgba(255, 206, 86, 1)",
               "rgba(75, 192, 192, 1)",
               "rgba(153, 102, 255, 1)",
               "rgba(255, 159, 64, 1)",
             ],
             borderWidth: 1,
           },
         ],
       },
       options: {
         scales: {
           yAxes: [
             {
               ticks: {
                 beginAtZero: true,
               },
             },
           ],
         },
       },
     }); // Chart
   } // Function









}); // Exit ready
