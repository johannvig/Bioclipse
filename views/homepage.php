<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/homepage.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioclipse</title>
</head>
<body>
    <div id="header">
        <img id="homepage" src="images/homepage.jpg" alt="">
        <div id="droite_acceuil">
            <h1>Bioclipse</h1>
            <h3>De la ferme à l'assiette</h3>
            <a id="btn_fonctionnement" href="#explication">En savoir plus</a>
        </div>
    </div>
    <div class="titre">
        <div class="semi_bar"></div>
        <h2>Les produits les plus vendus</h2>
        <div class="semi_bar"></div>
    </div>
    <div id="autre_produit">
            <div id="slider-container">
                <button id="slide-left">&#10094;</button>
                <div id="containeur_produit">
                    <?php
                        $produits = produit_by_productor(rand(11, 20));
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
    <a href="index.php?action=produits" id="voir_produit">Voir les produits</a>
    <div class="titre">
        <div class="semi_bar"></div>
        <h2>Le fonctionnement</h2>
        <div class="semi_bar"></div>
    </div>
    <div id="explication">
        <img src="images/3parti.png" alt="">
    </div>
    <div id="description">
        <div id="text">
            <h1>Qu'est ce que bioclipse ?</h1>
            <h2>BioClipse est une association dédiée au rapprochement entre consommateurs et divers producteurs, allant des bouchers aux pêcheurs et agriculteurs.</h2>
            <div class="container">
                <p>Les consommateurs peuvent découvrir une variété de producteurs locaux, allant des bouchers aux pêcheurs, et passer des commandes directement via la plateforme.</p>
            </div>
            <div class="container">
                <p>Les producteurs ont la possibilité de présenter leurs produits et services, recevoir des commandes et communiquer directement avec les consommateurs, renforçant ainsi les liens communautaires.</p>
            </div>
        </div>
        <img id="illustration" src="images/picture.svg" alt="image illustration">
    </div>
    <div id="fonctionnement">
        <img src="images/livraison.svg" alt="tracteur livreur">
        <div id="text">
            <h1>Comment fonctionne la livraison avec Bioclipse ?</h1>
            <h3>Chez Bioclipse, nous sommes fiers de notre modèle de livraison unique qui met en avant la communauté et l'entraide. Nos livraisons sont effectuées par des bénévoles dévoués qui parcourent nos régions à bord de camions pour acheminer vos produits frais directement de nos producteurs locaux jusqu'à votre porte.</h3>
            <p>Nous tenons à exprimer notre profonde gratitude envers tous nos bénévoles qui rendent ce service possible. Votre dévouement et votre générosité ne sont pas seulement le cœur de notre modèle de livraison, mais aussi l'âme de notre association. Merci de contribuer à créer un monde plus solidaire et durable.</p>
            <a href="#carte">Où trouver un relais paysan ?</a>
        </div>
    </div>
    <div class="titre">
        <div class="semi_bar"></div>
        <h2>Nos producteurs</h2>
        <div class="semi_bar"></div>
    </div>     
    <div id="carte">
        <div id="map" style="height:800px; width:80%;"></div>

        <?php
        $stores = get_map();?>
        <script>
        let latitude = 48.8566;// Coordonnées par défaut (Paris)
        let longitude = 2.3522;
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
            console.log(position.coords.latitude, position.coords.longitude);
            latitude=position.coords.latitude
            longitude=position.coords.longitude
            });
        } else {
            console.log("Geolocation is not available.");
        }
        function initMap() {
            var mapOptions = {
                center: new google.maps.LatLng(latitude, longitude), 
                zoom: 8
            };
            var map = new google.maps.Map(document.getElementById("map"), mapOptions);

            var geocoder = new google.maps.Geocoder();

            <?php foreach ($stores as $store): ?>
                geocodeAddress(geocoder, map, "<?php echo $store['Nom_compte']; ?>", "<?php echo $store['Adresse_postal_compte'] . ', ' . $store['Ville_compte'] . ', ' . $store['Code_postal_compte']; ?>", "<?php echo $store['Nom_categorie']; ?>");
            <?php endforeach; ?>

            function geocodeAddress(geocoder, resultMap, name, address, category) {
                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === 'OK') {
                        var marker = new google.maps.Marker({
                            map: resultMap,
                            position: results[0].geometry.location
                        });
                        var infoWindow = new google.maps.InfoWindow({
                            content: `<strong>${name}</strong><br>${address}<br>Catégorie : ${category}`
                        });
                        marker.addListener('click', function() {
                            infoWindow.open(resultMap, marker);
                        });
                        } else {
                            alert('Géocodage échoué pour l\'adresse suivante : ' + address + ' en raison de : ' + status);
                        }
                    });
                }
            }
        </script>
    </div>
    
    <!-- Intégration de l'API Google Maps JavaScript avec votre clé -->
    <?php $api_maps = $_ENV['API_MAPS'];?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_maps?>&callback=initMap" async defer></script>
    <script src="lib/scripts/homepage.js"></script>
</body>
</html>