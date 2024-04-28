<?php
require_once('controllers/client/settings.php');
require_once('controllers/producteur/settings.php');
require_once('controllers/administrator/settings.php');

function account()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'Client') {
            client_settings();
        } else if ($_SESSION['role'] == 'Producteur') {
            prod_settings();
        } else {
            admin_settings();
        }
    } else {
        header('Location: index.php?action=login');
    }
}
