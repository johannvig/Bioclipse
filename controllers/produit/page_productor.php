<?php
function page_productor(){
    require ('models/produit/page_productor.php');
    require_once('lib/database/Database.php');
    require_once ('lib/components/header.php');
    require_once ('views/produit/page_productor.php');
}
?>