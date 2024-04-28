<?php

function admin_settings(){
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
    require_once ('models/administrator/settings.php');
    $left_panel = get_panel();
    $settings = get_settings();
    if (isset($_POST['submit'])){
        updateSettings();
    }
    require_once ('views/administrator/settings.php');
}