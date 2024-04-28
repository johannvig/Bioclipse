<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/producer/profil.css">
    <title>Bioclipse</title>
</head>
<body>
    <div id="header">
    <?php 
        $id_producer = $_GET["id_productor"];
        $info_producers = producer_info($id_producer);
        foreach($info_producers as $info_producer){
            ?>
            <img id="producerImg" src="<?php echo $info_producer['Image_compte'];?>">
            <div id="nom_adresse"><h1><?php echo $info_producer["Nom_producteur"];?></h1><a href="https://www.google.fr/maps/place/<?php echo $info_producer["adresse_postal_compte"]; ?>"><?php echo $info_producer["adresse_postal_compte"]; ?></a></div>
            <?php
        }
        ?>
    </div>


    <div class="bar_separation"></div>
    <div id="produits">
        <?php
        $id_productor=$_GET["id_productor"];
        $produits = produit_by_productor($id_productor);
        if(isset($produits)){
            foreach($produits as $produit) { ?>
                <a href="index.php?action=produit&id_produit=<?php echo htmlspecialchars($produit["id_produit"]); ?>" class="card">
                    <img src="<?php echo htmlspecialchars($produit["image_produit"]); ?>" alt="<?php echo htmlspecialchars($produit["nom_produit"]); ?>">
                    <h3><?php echo htmlspecialchars($produit["nom_produit"]); ?></h3>
                    <p><?php echo htmlspecialchars($produit["prix_produit"]); ?> € / <?php echo htmlspecialchars($produit["unite_produit"]); ?></p>
                </a>
            <?php }
        }?>
    </div>
</body>
</html>