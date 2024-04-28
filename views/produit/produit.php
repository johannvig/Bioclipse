<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/produit/produit.css">
    <title>Document</title>
</head>
<body>
    <div id="page_produit">
        <div id="info_producteur">
        <?php 
            $result = affiche_produit($_GET["id_produit"]);
            if ($result) {
                if (count($result) > 0) {
                    $info_produit = $result[0]; ?>
                    <a id="nom_compte" href="index.php?action=prod_profil&id_productor=<?php echo htmlspecialchars($info_produit["id_compte"]);?>"><b><?php echo htmlspecialchars($info_produit["nom_compte"])." ".htmlspecialchars($info_produit["prenom_compte"]);?></b></a>
                    <a href=""><img src="images/localisation.svg"><?php echo htmlspecialchars($info_produit["adresse_postal_compte"]);?></a>
                <?php } 
                }
        ?>

        </div>
        <div id="titre">
            <h2><?php echo htmlspecialchars($info_produit["nom_produit"]);?></h2>
        </div>
        <div id="produit">
            <img id="image_produit" src="<?php echo htmlspecialchars($info_produit["image_produit"]);?>" alt="" style="object-fit: cover;">
            <div id="information_produit">
                
                <div>
                    <div>
                        <div id="prix_fav">
                            <h3>Prix</h3>
                        </div>
                    </div>
                    <div class="bar_separation"></div>
                    <p><?php echo htmlspecialchars($info_produit["prix_produit"]); ?> € le <?php echo htmlspecialchars($info_produit["Unite_produit"]); ?></p>
                    <h3>Description</h3>
                    <div class="bar_separation"></div>
                    <p><?php echo htmlspecialchars($info_produit["desc_produit"]);?></p>
                </div>
                <div id="conteneur_quantite">
                    <form method="post" id="footer_info_produit">
                        <div id="quantite_produit">
                            <?php 
                                if (!isset($_SESSION["Id_compte"])) {
                                    $quantite_article = 0;
                                }else{
                                    $result = affiche_quantite($_GET["id_produit"]);
                                    if (count($result) > 0) {
                                        $row = $result[0];
                                        $quantite_article = $row["quantite_article"];
                                    } else {
                                        $quantite_article = 0;
                                    }
                                }
                                $quantite_produit_list = affiche_nb_disponible($_GET["id_produit"]);
                                if (count($quantite_produit_list) > 0) {
                                    $row = $quantite_produit_list[0];
                                    $quantite_produit = $row["quantite_produit"];
                                }?>
                            <button type="button" id="btn_moins" onclick="add_retire_quantite(-1, <?php echo htmlspecialchars($quantite_produit); ?>)">-</button>
                            <input type="text" name="quantite" id="quantite_article" value="<?php echo htmlspecialchars($quantite_article); ?>" readonly> <!-- mettre en readonly ???? -->
                            <button type="button" id="btn_plus" onclick="add_retire_quantite(1, <?php echo htmlspecialchars($quantite_produit); ?>)">+</button>                  
                        </div>
                        <div id="ajout_produit_fav">
                            <input type="submit" class="disable" id="submit_panier" name="add_panier" value="Ajouter au panier">
                    </form>
                        <form method="post">
                            <?php 
                                if (!isset($_SESSION["Id_compte"])) {
                                    ?><input id="coeur_vide" class="coeur" name="favoris" type="submit" value="&#9825"><?php
                                }else{
                                $isFavorite = checkIfFavorite($_GET["id_produit"]);
                                if($isFavorite) {
                                    ?><input id="coeur_plein" class="coeur" name="favoris" type="submit" value="&#10084"><?php
                                } else {
                                    ?><input id="coeur_vide" class="coeur" name="favoris" type="submit" value="&#9825"><?php
                                }}
                            ?>
                        </form>
                        <form method="post">
                            <button type="submit" name="converser" id="converser" class="image-button">
                                <img src="images\producteur\messenger.png" alt="Converser">
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="autre_produit">
            <div id="titre_autre_produit">
                <h1>Autres produits de <?php echo htmlspecialchars($info_produit["nom_compte"]." ".$info_produit["prenom_compte"]); ?></h1>
                <div class="bar_separation"></div>
            </div>
            <div id="slider-container">
                <button id="slide-left">&#10094;</button>
                <div id="containeur_produit">
                    <?php
                        $produits = produit_by_productor($info_produit["id_compte"]);
                        foreach($produits as $produit) { ?>
                            <a href="index.php?action=produit&id_produit=<?php echo htmlspecialchars($produit["id_produit"]); ?>" class="card">
                                <img src="<?php echo htmlspecialchars($produit["image_produit"]); ?>" alt="<?php echo htmlspecialchars($produit["nom_produit"]); ?>" style="object-fit: cover;">
                                <h3><?php echo htmlspecialchars($produit["nom_produit"]); ?></h3>
                                <p><?php echo htmlspecialchars($produit["prix_produit"]); ?> € / <?php echo htmlspecialchars($produit["unite_produit"]); ?></p>
                            </a>
                        <?php } ?>
                </div>
                <button id="slide-right">&#10095;</button>
            </div>
        </div>

        <div id="containeur_avis">
            <div id="titre_avis">
                <h1>Les avis sur le produit</h1>
                <div class="bar_separation"></div>
            </div>
            <?php
            $all_avis = affiche_avis($_GET["id_produit"]);
            foreach($all_avis as $avis){?>
                        <div class="avis">
                            <img src="<?php echo htmlspecialchars($avis["image_compte"]);?>" alt="">
                            <div class="info_avis">
                                <h2><?php echo htmlspecialchars($avis["nom_compte"])." ".htmlspecialchars($avis["prenom_compte"]); ?></h2>
                                <div class="note">
                                    <?php for($i = 0; $i < floor($avis["note_avis"]); $i++) { ?>
                                        <p>&#9733</p>
                                    <?php } ?>
                                    <?php for($i=0; $i<5-floor($avis["note_avis"]);$i++){?>
                                        <p>&#9734</p>
                                    <?php } ?>
                                </div>
                                <p><?php echo htmlspecialchars($avis["commentaire_avis"]); ?></p>
                            </div>
                        </div>
                        <div class="separation"></div>
            <?php }?>
        </div>
    </div>
    <button id="btnCreateAvis">Donner votre avis</button>
    <div id="createProductModal" class="modal">
        <form method="post" class="modal-content">
            <a href="" id="btnAnnuler">X</a>
            <h2>Évaluer le produit</h2>
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5" /><label for="star5" title="5 étoiles">&#9734</label>
                <input type="radio" id="star4" name="rating" value="4" /><label for="star4" title="4 étoiles">&#9734</label>
                <input type="radio" id="star3" name="rating" value="3" /><label for="star3" title="3 étoiles">&#9734</label>
                <input type="radio" id="star2" name="rating" value="2" /><label for="star2" title="2 étoiles">&#9734</label>
                <input type="radio" id="star1" name="rating" value="1" /><label for="star1" title="1 étoile">&#9734</label>
            </div>
            <h2>Ajouter un commentaire</h2>
            <textarea id="description" name="commentaire_avis" placeholder="J'ai aimé le produit car ..." required></textarea>
            <input id="btnValider" type="submit" name="submit_avis" value="Valider l'avis">
        </form>
    </div>
    <script src="lib/scripts/produit/produit.js"></script>
</body>
</html>
