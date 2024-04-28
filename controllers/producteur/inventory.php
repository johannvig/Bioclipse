<?php

function inventory(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["Id_compte"])) {
        header("Location: index.php?action=login");
        exit();
    }
    if ($_SESSION["role"] != "Producteur") {
        header("Location: index.php");
        exit();
    }
    require_once('lib/components/Left_Panel.php');
    require_once('lib/database/Database.php');
    require ('lib/components/Table.php');
    require 'models/producteur/productManagement.php';
    require 'models/producteur/retailManagement.php';
    $left_panel= get_panel('inventory');
    $table = get_table();
    require 'views/producteur/inventory.php';

    
}



