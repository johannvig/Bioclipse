<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/panier/panier.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="page">
    <h1>Mon Panier</h1>
    <?php
        $producteurs = affiche_les_producteurs();
        foreach ($producteurs as $producteur){ 
            if(!check_produit($_SESSION["Id_compte"],$producteur["id_compte"])){
                continue;
            }?>
            <div class="header_productor">
                <div class="productor">
                    <img src="<?php echo $producteur["image_compte"]; ?>" alt="X">
                    <p> <?php echo $producteur["nom_compte"]." ".$producteur["prenom_compte"]; ?></p>
                    
                    <?php 
                                if (isset($_SESSION["Id_compte"])) {
                                    $adresseCompletProducteur = $producteur["adresse_postal_compte"]." ".$producteur["Code_postal_compte"]." ".$producteur["Ville_compte"];
                                    $adresseCompletClient = $_SESSION["adresse"]." ".$_SESSION["adresse_postal"]." ".$_SESSION["adresse_ville"];
                                    $distance = calculateDistance($adresseCompletClient, $adresseCompletProducteur);
                            ?>
                            <p class="distance"><?php echo $distance;?> km</p>
                        <?php } ?>
                </div>
                <h1><a href="index.php?action=produit_productor&id_productor=<?php echo $producteur["id_compte"]; ?>"><?php echo $producteur["nom_producteur"]; ?></a></h1>
                <div >
                    <a class="adresse" href="https://www.google.fr/maps/place/ <?php echo $producteur["adresse_postal_compte"];?>">
                        <img src="images/localisation.svg">
                        <p><?php echo $producteur["adresse_postal_compte"];?></p>
                    </a>
                </div>
            </div>
            <div class="bar_separation"></div>
            <div class="containeur_commande">
                <div class="containeur_all_produit">
                <?php 
                    $produits = affiche_produit_dans_panier($producteur["id_compte"]);
                    foreach ($produits as $produit) {
                        $result = affiche_quantite($produit["id_produit"]);
                        if ($result) {
                            if (count($result) > 0) {
                                $row = $result[0];
                                $quantite_article = $row["quantite_article"];
                            } else {
                                $quantite_article = 0;
                            }
                        }
                ?>

                        <div class="containeur_produit">
                            <a href="index.php?action=produit&id_produit=<?php echo $produit["id_produit"];?>"><img class="image_produit" src="<?php echo $produit["image_produit"];?>"  style="object-fit: cover; height:20vh; width:20vh;"></a>
                            <div class="info_produit">
                                <div class="nom_prix">
                                    <h3><?php echo $produit["nom_produit"];?></h3>
                                    <p><?php echo $produit["prix_produit"];?> €</p>
                                </div>
                                <div class="footer">
                                    <form method="post" class="conteur_quantite">
                                        <div class="info_quantite">
                                            <button type="button" class="btn" id="btn_moins<?php echo $produit["id_produit"];?>" onclick="add_retire_quantite(-1, <?php echo $produit['quantite_produit'].','.$produit['id_produit']; ?>)">-</button>
                                            <input type="hidden" name="id_produit" value="<?php echo $produit["id_produit"];?>">
                                            <input type="hidden" name="id_commande" value="<?php echo $produit["id_commande"];?>">
                                            <input type="text" class="quantite_article" name="quantite<?php echo $produit["id_produit"];?>" id="quantite_article<?php echo $produit["id_produit"];?>" value="<?php echo $quantite_article; ?>" readonly> <!-- mettre en readonly ???? -->
                                            <button type="button" class="btn" id="btn_plus<?php echo $produit["id_produit"];?>" onclick="add_retire_quantite(1, <?php echo $produit['quantite_produit'].','.$produit['id_produit']; ?>)">+</button>                  
                                        </div>
                                        <input type="submit" class="submit" name="submit_<?php echo $produit["id_produit"]; ?>" value="Ajouter au panier">
                                    </form>
                                    <form method="post">
                                        <input type="hidden" name="produit_a_supprimer" value="<?php echo $produit["id_produit"];?>">
                                        <input type="submit" class="delete" name="supprime_<?php echo $produit["id_produit"]; ?>" value="Supprimer">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php }?>
                        
                </div>
                <div class="conteneur_info_commande">
                    <div class="date">
                        <div class="header">
                            <h2>Date de récupération </h2>
                            <img src="" alt="">
                        </div>
                        <div class="date_form">
                            <h2>Choisissez votre date</h2>
                            <form method="post" class="containeur_form"> 
                                <input id="date" name="date_retrait" type="date">
                                <input type="hidden" name="id_prod" value="<?php echo $producteur["id_compte"]?>">
                                <div class="recapitulatif">
                                    <?php
                                    $commandes = affiche_produit_dans_panier($producteur["id_compte"]);
                                    $valeur_total = 0;

                                    foreach ($commandes as $commande) { ?>
                                        <?php $valeur_total = $valeur_total + $commande["quantite_article"]*$commande["prix_produit"]; ?>
                                    <?php }?>
                                    <p>Total </p><p><?php echo $valeur_total; ?> €</p>
                                </div>
                                <input id="submit" type="Submit" name="enregistrer_la_commande" value="Récupérer la commande">
                            </form>
                        </div>
                    </div>
                        
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <script src="lib/scripts/panier/panier.js"></script>
</body>
</html>
