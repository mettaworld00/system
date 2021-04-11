<?php

require_once '../config/db.php';
session_start();

/**
 * Mostrar ventas de las semama - 7 días atrás
------------------------------------------------------------- */

if ($_POST['action'] == 'ventaSemanal') {
    $db = Database::connect();

    $query1 = "SET @@lc_time_names = 'es_DO';";

    $query2 = "SELECT sum(total) AS 'total', dayname(created_at) AS 'dayname' FROM (
		
                SELECT sum(i.money_received)  AS 'total', i.created_at AS 'created_at' FROM invoices i 
                INNER JOIN users u ON i.user_id = u.user_id
                WHERE i.created_at BETWEEN date_add(NOW(), INTERVAL -7 DAY) AND NOW() 
                GROUP BY i.created_at
            
                UNION ALL

                SELECT sum(i.money_received) AS 'total', i.created_at AS 'created_at' FROM service_invoices i
                INNER JOIN users u ON i.user_id = u.user_id
                WHERE i.created_at BETWEEN date_add(NOW(), INTERVAL -7 DAY) AND NOW() 
                GROUP BY i.created_at
        
               ) ventas group by created_at";

             $db->query($query1);
    $datos = $db->query($query2);

    if ($datos->num_rows > 0){

        $result = $datos->fetch_all();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    } 
    

}

/**
 * Mostrar ventas por meses - 12 meses atrás
------------------------------------------------------------- */

if ($_POST['action'] == 'ventaMensual') {
    $db = Database::connect();

    $query1 = "SET @@lc_time_names = 'es_DO';";

    $query2 = "SELECT sum(total), monthname(created_at) as 'mes' FROM (

               SELECT sum(i.money_received) AS 'total', i.created_at AS 'created_at', s.status_name FROM invoices i 
                       INNER JOIN users u ON i.user_id = u.user_id
                       INNER JOIN status s on s.status_id = i.status_id
                       WHERE  s.status_name != 'Anulada' AND i.created_at >= date_sub(curdate(), INTERVAL 12 MONTH) AND NOW()
                       GROUP BY i.created_at
           
               UNION ALL 
                    
               SELECT sum(i.money_received) AS 'total', i.created_at AS 'created_at', s.status_name FROM service_invoices i 
                       INNER JOIN users u ON i.user_id = u.user_id
                       INNER JOIN status s on s.status_id = i.status_id
                       WHERE  s.status_name != 'Anulada' AND i.created_at >= date_sub(curdate(), INTERVAL 12 MONTH) AND NOW()
                       GROUP BY i.created_at              
                    
                    ) ventas group by mes order by created_at ASC";

             $db->query($query1);
    $datos = $db->query($query2);

    if ($datos->num_rows > 0){

        $result = $datos->fetch_all();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    } 
    

}