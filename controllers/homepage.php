<?php

function homepage(){
    require ('models/homepage.php');
    require ('models/produit/page_produit.php');
    require_once('lib/database/Database.php');
    require_once ('lib/components/header.php');
    require_once ('views/homepage.php');
    require_once ('lib/components/chatbot.php');
    require_once ('lib/components/footer.php');
}
