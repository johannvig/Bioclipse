<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/produit/page_produit.css">
    <link rel="stylesheet" href="styles/card_produit.css">
    <title>Document</title>
</head>
<body>
    <div id="header">
        <img src="images\produit\home_produit3.jpg" alt="">
        <div id="droite_acceuil">
            <h1>Produits frais</h1>
            <h3>De la ferme à l'assiette</h3>
            <a id="btn_fonctionnement" href="#search">En savoir plus</a>
        </div>
    </div>

    <h1 id="title"><strong>Des produits</strong> en vente directe aux alentours</h1>

    <div id="search">
        <select id="search_type" name="search_type" onchange="redirectToPage(this)">
            <option value="" selected>Produits</option>
            <option value="page_producteurs">Producteurs</option>
        </select>
        <form method="get" id="search_bar">
            <input type="hidden" name="action" value="produits">
            <input id="ville_producteur" name="ville_producteur" type="text" placeholder="Chercher un produit proche de chez vous" value="<?php echo isset($_GET['ville_producteur']) ? $_GET['ville_producteur'] : ''; ?>">
            <input type="submit" value=" " class="image-button">
        </form>
    </div>

    <button id="filterMenuButton"><img src="images/filtre.png" alt=""></button>

    <div id="filterMenu" class="hidden"> 

    <form method="get" id="search_filtre">
        <input type="hidden" name="action" value="produits">
        <div id="search_nom_produit">
            <input id="nom_produit" name="nom_produit" type="text" placeholder="Chercher nom produit" value="<?php echo isset($_GET['nom_produit']) ? $_GET['nom_produit'] : ''; ?>">
        </div>

        <div id="search_nom_producteur">
            <input id="nom_producteur" name="nom_producteur" type="text" placeholder="Chercher un producteur" value="<?php echo isset($_GET['nom_producteur']) ? $_GET['nom_producteur'] : ''; ?>">
        </div>

        

        <div id="search_min_prix">
            <input id="min_prix" name="min_prix" type="text" placeholder="Prix minimum" value="<?php echo isset($_GET['min_prix']) ? $_GET['min_prix'] : ''; ?>">
        </div>

        <div id="search_max_prix">
            <input id="max_prix" name="max_prix" type="text" placeholder="Prix maximum" value="<?php echo isset($_GET['max_prix']) ? $_GET['max_prix'] : ''; ?>">
        </div>


        <div id="producteurForm">
        <select id="type_produit" name="type_produit" onchange="submitFormWithAllParameters();">
            <option value="" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == '') ? 'selected' : ''; ?>>Voir tous les produits</option>
            <option value="pâtisserie" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == 'pâtisserie') ? 'selected' : ''; ?>>pâtisserie</option>
            <option value="viandes" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == 'viandes') ? 'selected' : ''; ?>>viandes</option>
            <option value="vin" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == 'vin') ? 'selected' : ''; ?>>vin</option>
            <option value="céréale" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == 'céréale') ? 'selected' : ''; ?>>céréale</option>
            <option value="produit laitier" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == 'produit laitier') ? 'selected' : ''; ?>>produit laitier</option>
            <option value="pain" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == 'pain') ? 'selected' : ''; ?>>pain</option>
            <option value="poisson" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == 'poisson') ? 'selected' : ''; ?>>poisson</option>
            <option value="produit laitier" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == 'produit laitier') ? 'selected' : ''; ?>>produit laitier</option>
            <option value="fruits et légumes" <?php echo (isset($_GET['type_produit']) && $_GET['type_produit'] == 'fruits et légumes') ? 'selected' : ''; ?>>fruits et légumes</option>
        </select>
    </div>


       

    <div id="produitTriForm">
        <select id="tri_produit" name="tri_produit" onchange="submitFormWithAllParameters();">
            <option value="" <?php echo (isset($_GET['tri_produit']) && $_GET['tri_produit'] == '') ? 'selected' : ''; ?>>Voir le tri</option>
            <option value="ASC" <?php echo (isset($_GET['tri_produit']) && $_GET['tri_produit'] == 'Croissant') ? 'selected' : ''; ?>>Croissant</option>
            <option value="DESC" <?php echo (isset($_GET['tri_produit']) && $_GET['tri_produit'] == 'Décroissant') ? 'selected' : ''; ?>>Décroissant</option>
        </select>
        </div>

    <button type="submit">Soumettre</button>

    </form>
    </div>
    
    <?php
        

        $results = affiche_producteur($searchQuery, $selector, $nom_produit, $nom_producteur, $min_prix, $max_prix);
        trier($results); 

        $producteursAffiches = [];
        if (isset($results)) {
            foreach ($results as $result) {

               
                ?>
                <div class="header_productor">
                    <div class="productor">
                        <img src="<?php echo htmlspecialchars($result["image_compte"]); ?>" alt="Image du producteur">
                        <p><?php echo htmlspecialchars($result["nom_compte"]) . " " . htmlspecialchars($result["prenom_compte"]); ?></p>
                        <?php 
                                if (isset($_SESSION["Id_compte"])) {
                                    $adresseCompletProducteur = $result["adresse_postal_compte"]." ".$result["Code_postal_compte"]." ".$result["Ville_compte"];
                                    $adresseCompletClient = $_SESSION["adresse"]." ".$_SESSION["adresse_postal"]." ".$_SESSION["adresse_ville"];
                                    $distance = calculateDistance($adresseCompletClient, $adresseCompletProducteur);
                            ?>
                            <p><?php echo $distance;?> km</p>
                        <?php } ?>
                    </div>
                    <h1><a href="index.php?action=prod_profil&id_productor=<?php echo htmlspecialchars($result["id_compte"]); ?>"><?php echo htmlspecialchars($result["nom_producteur"]); ?></a></h1>
                    <div>
                        <a class="adresse" href="https://www.google.fr/maps/place/<?php echo htmlspecialchars($result["adresse_postal_compte"]); ?>">
                            <img src="images/localisation.svg" alt="Localisation">
                            <p><?php echo htmlspecialchars($result["adresse_postal_compte"]); ?></p>
                        </a>
                    </div>
                </div>
                <div class="bar_separation"></div>
                <div class="produits">
                    <?php
                    $produits = search_produit($result["id_compte"], $searchQuery, $nom_produit, $nom_producteur, $selector, $min_prix, $max_prix, $tri_produit);
                    if (isset($produits)) {
                        foreach ($produits as $produit) {
                            ?>
                            <a href="index.php?action=produit&id_produit=<?php echo $produit["Id_produit"]; ?>" class="card">
                                <img class="product-image" src="<?php echo htmlspecialchars($produit["Image_produit"]); ?>" alt="Image du produit">
                                <h3><?php echo htmlspecialchars($produit["Nom_produit"]); ?></h3>
                                <p><?php echo htmlspecialchars($produit["Prix_produit"]); ?> € /<?php echo htmlspecialchars($produit["Unite_produit"]); ?></p>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php // Fin du bloc HTML
            }
        }
    ?>

    <script src="lib/scripts/produit/page_produit.js" defer></script>
</body>
</html>



