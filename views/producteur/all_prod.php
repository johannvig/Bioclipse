<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/producer/all_prod.css">
    <title>Bioclipse</title>
</head>
<body>
    <div id="header">
        <img src="images\producteur\home_producteur.jpg" alt="">
        <div id="droite_acceuil">
            <h1>Produit frais</h1>
            <h3>De la ferme à l'assiette</h3>
        </div>
    </div>
    <h1 id="title"><strong>Producteur</strong> en vente directe aux alentours de <strong>Chez vous</strong></h1>

    <div id="search">
        <select id="search_type" name="search_type" onchange="redirectToPage(this)">
            <option value="" selected>Producteurs</option>
            <option value="page_produits">Produits</option>
        </select>
        <form method="get" id="search_bar">
            <input type="hidden" name="action" value="all_prod">
            <input id="ville_producteur" name="ville_producteur" type="text" placeholder="Chercher un producteur proche de chez vous" value="<?php echo isset($_GET['ville_producteur']) ? $_GET['ville_producteur'] : ''; ?>">
            <input type="submit" value=" " class="image-button">
        </form>

    </div>
    <button id="filterMenuButton"><img src="images/filtre.png" alt=""></button>

    <div id="filterMenu" class="hidden"> 

        <form method="get" id="producteurForm">

            <input type="hidden" id="action" name="action" value="all_prod">
            
            <div id="search_nom_producteur">
                <input id="nom_producteur" name="nom_producteur" type="text" placeholder="Chercher nom producteur" value="<?php echo isset($_GET['nom_producteur']) ? $_GET['nom_producteur'] : ''; ?>">
            </div>


            <select id="type_producteur" name="type_producteur" onchange="this.form.submit();">
                <option value="" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == '') ? 'selected' : ''; ?>>Voir tous les producteurs</option>
                <option value="Maraîcher" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == 'Maraîcher') ? 'selected' : ''; ?>>Maraîcher</option>
                <option value="Poissonnerie" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == 'Poissonnerie') ? 'selected' : ''; ?>>Poissonnerie</option>
                <option value="Boucherie" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == 'Boucherie') ? 'selected' : ''; ?>>Boucherie</option>
                <option value="Viticole" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == 'Viticole') ? 'selected' : ''; ?>>Viticole</option>
                <option value="Céréalier" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == 'Céréalier') ? 'selected' : ''; ?>>Céréalier</option>
                <option value="Fromager" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == 'Fromager') ? 'selected' : ''; ?>>Fromager</option>
                <option value="Laitier" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == 'Laitier') ? 'selected' : ''; ?>>Laitier</option>
                <option value="Pâtisserie" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == 'Pâtisserie') ? 'selected' : ''; ?>>Pâtisserie</option>
                <option value="Boulangerie" <?php echo (isset($_GET['type_producteur']) && $_GET['type_producteur'] == 'Boulangerie') ? 'selected' : ''; ?>>Boulangerie</option>
            </select>

            <button class="filtre" type="submit">Soumettre</button>

        </form>
    </div>

        
        
    </div>

          
    <div id="container_all_prod">
        <?php

            $results = affiche_compte($searchQuery, $selector,$nom_producteur);
            
            trierProducteurs($results); 

            foreach($results as $productor){?>
                <div class="producteur">
                    <div class="producteur_affichage">
                        <img class="image_prod" src="<?php echo htmlspecialchars($productor["Image_compte"]); ?>" alt="Image du producteur">
                        <?php 
                                if (isset($_SESSION["Id_compte"])) {
                                    $adresseCompletProducteur = $productor["Adresse_postal_compte"]." ".$productor["Code_postal_compte"]." ".$productor["Ville_compte"];
                                    $adresseCompletClient = $_SESSION["adresse"]." ".$_SESSION["adresse_postal"]." ".$_SESSION["adresse_ville"];
                                    $distance = calculateDistance($adresseCompletClient, $adresseCompletProducteur);
                            ?>
                            <p><?php echo $distance;?> km</p>
                        <?php } ?>
                    </div>
                    <div class="producteur_info">
                        <h3><?php echo $productor["Nom_producteur"];?></h3>
                        <p><?php echo $productor["Nom_categorie"];?></p>
                    </div>
                    <div>
                        <img src="images/localisation.png" alt="">
                        <p><?php echo $productor["Adresse_postal_compte"];?></p>
                    </div>
                    <a href="index.php?action=prod_profil&id_productor=<?php echo $productor["Id_compte"];?>" class="decouvrir">
                        <img src="images/feuille.png" alt="">
                        Découvrir ce producteur
                    </a>
                </div>
            <?php }?>
    </div>
    <script src="lib/scripts/producteur/all_prod.js" defer></script>
</body>
</html>