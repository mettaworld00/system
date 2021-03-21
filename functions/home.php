<?php

require_once '../config/db.php';
session_start();

/**
 * Mostrar ventas de las semama - 7 días atrás
------------------------------------------------------------- */

if ($_POST['action'] == 'ventaSemanal') {
    $db = Database::connect();

    $warehouseID = $_SESSION['identity']->warehouse_id;

    $query1 = "SET @@lc_time_names = 'es_DO';";

    $query2 = "SELECT sum(i.money_received), dayname(i.created_at) FROM invoices i 
               INNER JOIN users u ON i.user_id = u.user_id
               WHERE u.warehouse_id = '$warehouseID' AND i.created_at BETWEEN date_add(NOW(), INTERVAL -7 DAY) AND NOW()
               GROUP BY i.created_at";

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

    $warehouseID = $_SESSION['identity']->warehouse_id;


    $query1 = "SELECT sum(i.money_received), monthname(i.created_at) FROM invoices i 
               INNER JOIN users u ON i.user_id = u.user_id
               INNER JOIN status s on s.status_id = i.status_id
               WHERE  s.status_name != 'Anulada' AND u.warehouse_id = '$warehouseID' AND i.created_at >= date_sub(curdate(), INTERVAL 12 MONTH) 
               GROUP BY monthname(i.created_at)";

    $datos = $db->query($query1);

    if ($datos->num_rows > 0){

        $result = $datos->fetch_all();
        echo json_encode($result, JSON_UNESCAPED_UNICODE);

    } 
    

}