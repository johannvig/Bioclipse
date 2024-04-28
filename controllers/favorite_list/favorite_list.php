<?php
function favorite_list(){  
    if (!isset($_SESSION["Id_compte"])) {
        header("Location: index.php?action=login");
        exit();
    }  
    require('models/favorite_list/favorite_list.php');

    require_once('lib/database/Database.php');
    require_once ('lib/components/header.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['monSelecteur'])) {
        $newLocation = "favoris?";
        $parameters = array();
    
        // filtrer par le + ou - récent
        if (isset($_POST['monSelecteur'])) {
            $parameters[] = "tri=" . urlencode($_POST['monSelecteur']);
        } elseif ($sortOrder) {
            $parameters[] = "tri=" . urlencode($sortOrder);
        }
    
        // Construction et redirection vers la nouvelle URL
        $newLocation .= implode('&', $parameters);
        header("Location: index.php?action=" . $newLocation);
        exit;
    } 
    
    require('views/favorite_list/favorite_list.php');
    require_once ('lib/components/footer.php');
}

  