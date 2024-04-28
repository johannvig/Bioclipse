<?php

require_once("../vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();


require_once ('controllers/client/settings.php');
require_once ('controllers/produit/page_productor.php');


if (isset($_GET['action']) && $_GET['action'] != '') {
    switch ($_GET['action']) {
        case 'produit':
            require_once ('controllers/produit/produit.php');
            produit();
            break;
        case 'all_prod':
            require_once ('controllers/producteur/all_prod.php');
            all_prod();
            break;
        case 'commande':
            require_once ('controllers/commande/commande.php');
            voir_commande();
            break;
        case 'modify_product':
            require_once ('controllers/producteur/modifyProduct.php');
            modify_product();
            break;
        case 'panier':
            require_once ('controllers/panier/panier.php');
            panier();
            break;
        case 'produits':
            require_once ('controllers/produit/page_produit.php');
            page_produit();
            break;
        case 'messagerie':
            require_once ('controllers/message/message.php');
            message();
            break;
        case 'compte':
            require_once ('controllers/account/account.php');
            account();
            break;
        case 'historique':
            require_once ('controllers/client/historical.php');
            client_historical();
            break;
        case 'login':
            require_once ('controllers/session/connection.php');
            connection();
            break;
        case 'password_forgotten':
            require_once ('controllers/session/password_forgotten.php');
            password_forgotten();
            break;
        case 'password_change':
            require_once ('controllers/session/password_change.php');
            password_change();
            break;
        case 'registration':
            require_once ('controllers/session/registration.php');
            registration();
            break;
        case 'inventory': 
            require_once ('controllers/producteur/inventory.php');
            inventory();
            break;
        case 'order_history': 
            require_once ('controllers/producteur/orderHistory.php');
            order_history();
            break;
        case 'create_product': 
            require_once ('controllers/producteur/createProductController.php');
            create_product();
            break;
        case 'confidentiality': 
            require_once ('controllers/confidentiality/confidentiality.php');
            confidentiality();
            break;
        case 'favoris': 
            require_once ('controllers/favorite_list/favorite_list.php');
            favorite_list();
            break;
        case 'accueil':
            require_once ('controllers/homepage.php');
            homepage();
            break;
        case 'faq':
            require_once ('controllers/faq/faq.php');
            faq();
            break;
        case 'admin_producteurs':
            require_once ('controllers/administrator/producers.php');
            admin_producers();
            break;
        case 'copyright':
            require_once ('controllers/copyright/copyright.php');
            copyright();
            break;
        default:
            require_once ('controllers/homepage.php');
            homepage();
            break;
    }
} else {
    require_once ('controllers/homepage.php');
    homepage();
}