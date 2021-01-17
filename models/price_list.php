<?php

require_once 'modelo.php';

class Price_list extends ModeloBase {

    public function __construct()
    {
        parent::__construct();
    }

    public function showPrice_list(){
        $query = "SELECT * from price_lists";

        return $this->db->query($query);
    }

}