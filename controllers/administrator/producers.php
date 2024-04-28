<?php

function admin_producers()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["Id_compte"])) {
        header("Location: index.php?action=login");
        exit();
    }
    if ($_SESSION["role"] != "Administrateur") {
        header("Location: index.php");
        exit();
    }
    require_once("models/message/message.php");
    require_once("lib/database/Database.php");
    if (isset($_GET["create_group"])) {
        if ($_GET["create_group"] == "producers") {
            $id = create_liste_diffusion();
            $producers = all_name_producers();
            foreach ($producers as $producer) {
                add_contact_groupe($id, $producer["Id_compte"]);
            }
            header("Location: index.php?action=messagerie&correspondant=" . $id);
            exit();
        } else if ($_GET["create_group"] == "clients") {
            $id = create_liste_diffusion();
            $clients = all_name_clients();
            foreach ($clients as $client) {
                add_contact_groupe($id, $client["Id_compte"]);
            }
            header("Location: index.php?action=messagerie&correspondant=" . $id);
            exit();
        }
    }
    require_once('models/administrator/producers.php');
    $table_validation = get_tableValidation();
    if (isset($table_validation)) {
        $table_producers = get_tableProducers(1);
    } else {
        $table_producers = get_tableProducers(0);
    }
    $left_panel = get_panel();
    require_once('views/administrator/producers.php');
}
