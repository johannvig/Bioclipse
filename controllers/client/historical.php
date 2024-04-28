<?php

function client_historical(){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["Id_compte"])) {
        header("Location: index.php?action=login");
        exit();
    }
    if ($_SESSION["role"] != "Client") {
        header("Location: index.php");
        exit();
    }
    require ('lib/database/Database.php');
    require ('lib/components/Left_Panel.php');
    require ('lib/components/Table.php');
    require ('models/client/historical.php');

    if (!isset($_SESSION["Id_compte"])) {
        header("Location: index.php?action=login");
        exit();
    }
    if (isset($_POST["id_commande"])) {
        if (isset($_POST["submit"])) {
            if ($_POST["submit"] == "Voir le détail de la commande") {
                header("Location: index.php?action=commande&id_commande=" . $_POST["id_commande"]);
                exit();
            } else if ($_POST["submit"] == "Annuler la commande") {
                supprime_commande($_POST["id_commande"]);
            }
        }
    }
    
    $table = get_table();
    $left_panel= get_panel('historique');
    require ('views/client/historical.php');

}
?>
