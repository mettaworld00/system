<?php

require_once './models/contacts.php';

class ContactsController
{

    public function index()
    {   
         $method = new Contacts();
         $customers = $method->showCustomers();

        require_once './views/contacts/index.php';
     
    }

    public function add()
    {
        require_once './views/contacts/add.php';
    }

}