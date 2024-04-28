<?php 
foreach ($_POST as $key => $value) {
    if (strpos($key, 'removeFavoris_') === 0) {
        $id = str_replace('removeFavoris_', '', $key);
        delete_fav($id);
        header("Location: index.php?action=favoris");
        exit();
    } elseif (strpos($key, 'addFavoris_') === 0) {
        $id = str_replace('addFavoris_', '', $key);
        add_favoris($id);
        header("Location: index.php?action=favoris");
        exit();
    }
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/favorite_list/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioclipse</title>
</head>
<body>
    <div id=intro>
        <h1 id="titre">Liste des favoris</h1>
        <div id="filtre">
            <form id="monFormulaire" method="post">
                <select name="monSelecteur" id="monSelecteur">
                    <option value="ASC">Trié par : </option>
                    <option value="ASC">Trié par : le - cher</option>
                    <option value="DESC">Trié par : le + cher</option>
                </select>
            </form>
        </div>
        <?php     
        $tri = $_GET['tri'] ?? null;
        $fav = getIdProd($tri);?>
        <?php if ($tri != null) { ?>
            <p><?php echo "Critère de tri actuel : " . ($tri === "ASC" ? "croissant" : "décroissant"); ?></p>
        <?php } ?>
    </div>
    <div class="ligne"></div>

    <div id="card">
        <?php
            
            foreach ($fav as $favorite) {
                if (isset($favorite['id_produit'])) {
                    $prod = getFav($favorite['id_produit'], $tri);
                    foreach ($prod as $product) {
                    ?>

                        <a class="repet" href="index.php?action=produit&id_produit=<?php echo $product["Id_produit"];?>">
                            <img id="imgProd" src="<?php echo htmlspecialchars($product['Image_produit']) ?>" alt="Image produit">
                            <div class=sep>
                                <div class="texts" >
                                    <?php
                                    $nom = $product['Nom_produit'];
                                    if (!empty($nom)) {
                                        $contenu_nom = $nom;
                                        $nom_tronque = substr($contenu_nom, 0, 16);

                                        if (strlen($contenu_nom) > 15) {
                                            $nom_tronque .= '...'; 
                                        }
                                    }?>

                                    <h2 class="titre"><?php echo htmlspecialchars($nom_tronque) ?></h2>
                                    <p class="desc">
                                    <?php $desc = $product['Desc_produit'];
                                    if (!empty($desc)) {
                                        $contenu_desc = $desc;
                                        $desc_tronque = substr($contenu_desc, 0, 51);

                                        if (strlen($contenu_desc) > 50) {
                                            $desc_tronque .= '...'; 
                                        }
                                    }?>    
                                    
                                    <?php echo htmlspecialchars($desc_tronque) ?></p>
                                    <p class="prix"><?php echo htmlspecialchars($product['Prix_produit']); ?> € / 
                                    <?php echo htmlspecialchars($product['Unite_produit']); ?></p>
                                </div>
                                <form method="post">
                                    <?php 
                                        $Id_produit = $product['Id_produit'];
                                        $isFavorite = checkIfFavorite($Id_produit);

                                        if(!empty($isFavorite)) {
                                            ?><input id="coeur_plein" class="coeur" name="removeFavoris_<?php echo $Id_produit; ?>" type="submit" value="&#10084"><?php
                                        } else {
                                            ?><input id="coeur_vide" class="coeur" name="addFavoris_<?php echo $Id_produit; ?>" type="submit" value="&#9825"><?php
                                        }
                                    ?>
                                </form>
                                
                            </div>
                        </a>
                        <?php
                    }
                }
                ?><?php
            }            
        ?>
    </div>
    <div class="ligne"></div>
    <script src="lib/scripts/produit/page_produit.js" defer></script>
    <script src="lib/scripts/favorite_list/favorite_list.js" defer></script>
    
</body>
</html>