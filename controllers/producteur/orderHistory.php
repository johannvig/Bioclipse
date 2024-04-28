<?php

function order_history()
{

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

    /*

    Liaison fichiers

    */




    require_once('lib/components/Left_Panel.php');
    require_once('lib/components/Table.php');
    require_once('lib/database/Database.php');
    require_once('models/producteur/orderHistory.php');
    require_once('models/message/load_message.php');

    /*

    Vérification des requêtes

    */





    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['commandId']) && isset($_POST['status'])) {

        $commandId = filter_input(INPUT_POST, 'commandId', FILTER_SANITIZE_NUMBER_INT);
        $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

        if ($status && $commandId) {


            setStatut($status, $commandId);

            header('Location: index.php?action=order_history');
            exit();
        }


        $newLocation = "order_history?";
        $parameters = array();

        // Filtre de recherche
        $postSortOrder = filter_input(INPUT_POST, 'monSelecteur', FILTER_SANITIZE_STRING);
        if ($postSortOrder) {
            $parameters[] = "sort=" . urlencode($postSortOrder);
        } elseif ($sortOrder) {
            $parameters[] = "sort=" . urlencode($sortOrder);
        }

        $postClientName = filter_input(INPUT_POST, 'client_name', FILTER_SANITIZE_STRING);
        $postClientName = htmlspecialchars($postClientName, ENT_QUOTES, 'UTF-8');
        if ($postClientName) {
            $parameters[] = "client_name=" . urlencode($postClientName);
        } elseif ($searchQuery) {
            $parameters[] = "client_name=" . urlencode($searchQuery);
        }

        // Construction de l'URL avec tous les paramètres
        $newLocation .= implode('&', $parameters);

        // Redirection
        header("Location: index.php?action=" . $newLocation);
        exit;
    }

    if (isset($_GET["id_commande"])) {
        talkToClient($_GET["id_commande"]);
    }
    $left_panel = get_panel('order_history');
    $table = get_table();
    require 'views/producteur/orderHistory.php';
}
