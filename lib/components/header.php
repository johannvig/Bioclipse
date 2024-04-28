<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/components/header.css">
    <title>Bioclipse</title>
</head>

<body>
    <header>
        <div id="navBar">
            <div id="logo">
                <a href="index.php?action=index.php">
                    <img src="images/logo.png" alt="">
                </a>
            </div>
            <nav>
                <a href="index.php?action=accueil">Accueil</a>
                <a href="index.php?action=produits">Produits</a>
                <?php if (isset($_SESSION["role"]) && $_SESSION["role"] == "Client") { ?>
                <a href="index.php?action=panier">Panier</a><?php } ?>
                <?php if (empty($_SESSION["role"])) { ?>
                <a href="index.php?action=panier">Panier</a><?php } ?>
                <a href="index.php?action=favoris">Favoris</a>
            </nav>
            <div id="conteneurbtn">
                <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start(); // ouvre la session si elle n'est pas déjà ouverte
                }
                if (isset($_SESSION["role"]) && $_SESSION["email"] != null) {
                    if (isset($_SESSION["image"])) {
                ?>
                        <img src="<?php echo $_SESSION["image"]; ?>" alt="">
                    <?php
                    } else {
                    ?>
                        <img src="images/profil_pic/profil.png" alt="">
                    <?php
                    }
                    ?>
                    <a href="index.php?action=compte">Votre Compte</a>
                <?php
                } else {
                ?>
                    <a href="index.php?action=login">Se connecter</a>
                <?php
                }
                ?>

            </div>
        </div>
    </header>
</body>

</html>