<?php

function prod_settings()
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
    require_once('lib/components/Left_Panel.php');
    require_once('lib/database/Database.php');
    require_once('lib/components/Settings.php');
    require_once('models/producteur/settings.php');
    $left_panel = get_panel("compte");
    $settings = get_settings();
    if (isset($_POST['submit'])) {
        updateSettings();
    }   
    require_once('views/producteur/settings.php');
}
