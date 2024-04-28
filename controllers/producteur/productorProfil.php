<?php
function prod_profil(){    
    require_once('lib/database/Database.php');
    require('models/producteur/productorProfil.php');
    require_once ('lib/components/header.php');
    require('views/producteur/profil/productorProfil.php');
    require_once ('lib/components/footer.php');
}