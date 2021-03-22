<?php

class Help
{

   /*
   *  Productos
   *  -----------------------------------------------------------------------------------------------------
   * */

   // Función para mostrar las unidades de medida

   public static function showUnits()
   {
      $query = "SELECT *FROM units";

      $db = Database::connect();
      return $db->query($query);
   }

   // Función para mostrar categorias

   public static function showCategories()
   {
      $query = "SELECT *FROM categories";

      $db = Database::connect();
      return $db->query($query);
   }

   // Función para mostrar impuestos

   public static function showTaxes()
   {
      $query = "SELECT *FROM taxes";

      $db = Database::connect();
      return $db->query($query);
   }

   // Función para mostrar almacenes

   public static function showWarehouses()
   {
      $query = "SELECT *FROM warehouses";

      $db = Database::connect();
      return $db->query($query);
   }

   // Función para mostrar descuentos

   public static function showDiscounts()
   {
      $query = "SELECT *FROM discounts";

      $db = Database::connect();
      return $db->query($query);
   }

   // Función para mostrar las lista de precios de un producto

   public static function showPriceListProduct($product_id)
   {
      $query = "SELECT *FROM products p 
      INNER JOIN products_price_lists pp ON p.product_id = pp.product_id
      INNER JOIN price_lists pl ON pp.list_id = pl.list_id
      WHERE p.product_id = '$product_id'";

      $db = Database::connect();
      return $db->query($query);
   }

   // Función para mostrar tipos de ajuste de inventario

   public static function showType_item_setting()
   {
      $query = "SELECT *FROM type_item_settings";

      $db = Database::connect();
      return $db->query($query);
   }


   // Función para mostrar productos por id


   public static function showProductId($product_id)
   {

      $query = "SELECT p.product_id, p.product_name, p.product_code, p.price_in, p.price_out, 
      p.quantity, p.inventary_min, p.expiration, p.created_at, c.category_id, 
      c.category_name, d.discount_id, d.discount_name, d.discount_value, t.tax_id, t.tax_name, 
      t.tax_value, w.warehouse_id, w.warehouse_name, u.unit_id, u.unit_name FROM products p 
            LEFT JOIN products_categories pc ON p.product_id = pc.product_id
            LEFT JOIN categories c ON pc.category_id = c.category_id
            LEFT JOIN products_discounts pd ON p.product_id = pd.product_id
            LEFT JOIN discounts d ON pd.discount_id = d.discount_id
            LEFT JOIN products_taxes pt ON p.product_id = pt.product_id
            LEFT JOIN taxes t ON pt.tax_id = t.tax_id
            LEFT JOIN products_warehouses pw ON p.product_id = pw.product_id
            LEFT JOIN warehouses w ON pw.warehouse_id = w.warehouse_id
            LEFT JOIN units u ON p.unit_id = u.unit_id
            WHERE p.product_id = '$product_id'";

      $db = Database::connect();
      return $db->query($query);
   }

   // Función para mostrar productos

   public static function showProducts()
   {

      $warehouseID = $_SESSION['identity']->warehouse_id;

      $query = "SELECT *FROM products p 
      INNER JOIN warehouses w on p.warehouse_id = w.warehouse_id 
      INNER JOIN status s ON p.status_id = s.status_id
      WHERE s.status_name = 'Activo' AND w.warehouse_id = $warehouseID ";

      $db = Database::connect();
      return $db->query($query);
   }

   // Función para mostrar lista de precios

   public static function showPrice_list()
   {

      $query = "SELECT *FROM price_lists";

      $db = Database::connect();
      return $db->query($query);
   }


   /**
    * Clientes
    * -------------------------------------------------------------------------------------------------
    */

   public static function showCustomers()
   {
      $query = "SELECT *FROM customers";

      $db = Database::connect();
      return $db->query($query);
   }

   /**
    *  Facturación
    * ----------------------------------------------------------------------------------------------------
    */


   // Función para mostrar métodos de pagos

   public static function showPayments_methods()
   {

      $db = Database::connect();

      $query = "SELECT *FROM payment_methods";

      return $db->query($query);
   }

   // Función para mostras clientes de la compra 


   public static function showPurchaseDataCustomer($id)
   {

      $db = Database::connect();

      $query = "SELECT *FROM invoice_detail id 
      INNER JOIN invoices i ON id.invoice_id = i.invoice_id
      INNER JOIN customers c ON i.customer_id = c.customer_id WHERE id.invoice_id = '$id' LIMIT 1";

      return $db->query($query);
   }

   // Función para mostrar los datos de una factura

   public static function showInvoice($id)
   {

      $db = Database::connect();

      $query = "SELECT 
      i.invoice_id, i.noinvoice, i.total_invoice, i.money_received, i.pending, i.expiration, i.created_at as 'date',
      c.customer_name, c.rnc, c.telephone1, s.status_name, p.payment_name, u.user_id, u.username, u.name
      FROM invoices i 
      INNER JOIN customers c ON i.customer_id = c.customer_id
      INNER JOIN status s ON i.status_id = s.status_id 
      INNER JOIN payment_methods p ON i.payment_id = p.payment_id
      INNER JOIN users u ON i.user_id = u.user_id 
      WHERE i.invoice_id = '$id'";

      return $db->query($query);
   }

   // Función para mostrar el detalle de una factura

   public static function showDetail($id)
   { 

      $db = Database::connect();

      $query = "SELECT 
      id.invoice_id, id.invoice_detail_id, id.total_quantity, id.total_price, id.discount, 
      p.product_id, p.product_name, p.price_out, p.product_code, p.quantity as 'stock' 
      FROM invoice_detail id 
      INNER JOIN products p ON id.product_id = p.product_id 
      WHERE id.invoice_id = '$id'";

      return $db->query($query);
   }

   /**
    * Servicios
    ------------------------------------------------------*/


   // Funcion para mostrar los servicios

   public static function showServices()
   {
      $query = "SELECT *FROM services";

      $db = Database::connect();
      return $db->query($query);
   }

   // Función para mostrar los datos de una factura

   public static function showServiceInvoice($id)
   {

      $db = Database::connect();

      $query = "SELECT 
      si.service_invoice_id, si.noinvoice, si.total_invoice, si.money_received, si.pending, si.expiration, si.created_at as 'date',
      c.customer_name, c.rnc, c.telephone1, s.status_name, p.payment_name, u.user_id, u.username, u.name
      FROM service_invoices si 
      INNER JOIN customers c ON si.customer_id = c.customer_id
      INNER JOIN status s ON si.status_id = s.status_id 
      INNER JOIN payment_methods p ON si.payment_id = p.payment_id
      INNER JOIN users u ON si.user_id = u.user_id 
      WHERE si.service_invoice_id = '$id'";

      return $db->query($query);
   }

   // Función para mostrar el detalle de una factura

   public static function showServiceDetail($id)
   { 

      $db = Database::connect();

      $query = "SELECT 
      sd.service_invoice_id, sd.service_detail_id, sd.total_quantity, sd.total_price, sd.discount, 
      s.service_id, s.service_name, s.price 
      FROM service_detail sd 
      INNER JOIN services s ON sd.service_id = s.service_id 
      WHERE sd.service_invoice_id = '$id'";

      return $db->query($query);
   }

   /**
    * Transaciones
   ------------------------------------------------ */

   // Función para mostrar los datos de una factura a crédito

   public static function showTransactionIN($id)
   {

      $db = Database::connect();

      $query = "SELECT 
      i.invoice_id, i.noinvoice, i.total_invoice, i.money_received, i.pending, i.expiration, i.created_at as 'date',
      c.customer_name, c.rnc, c.telephone1, s.status_name, p.payment_name, u.user_id, u.username, u.name
      FROM invoices i 
      INNER JOIN customers c ON i.customer_id = c.customer_id
      INNER JOIN status s ON i.status_id = s.status_id 
      INNER JOIN payment_methods p ON i.payment_id = p.payment_id
      INNER JOIN users u ON i.user_id = u.user_id 
      WHERE i.invoice_id = '$id'";

      return $db->query($query);
   }

}
