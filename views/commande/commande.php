

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facture</title>
    <link rel="stylesheet" href="styles/commande/commande.css">
</head>
<body>

<div class="invoice-container">
<header class="invoice-header">
            <div class="invoice-logo">
                <img src="images\logo.png" alt="Logo" height="70px" width="70px"/>
            </div>
            <div class="invoice-title">
                <h1>Facture</h1>
            </div>
        </header>
        <?php $orderInfo = donne_info_commande($_GET["id_commande"]);
        $clientInfo = $orderInfo[0];
         if (isset($clientInfo)): ?>
        <section class="invoice-info">
            <div class="invoice-client">
                <h2>Client</h2>
                <p><?php echo $clientInfo["Nom_client"] . " " . $clientInfo["Prenom_client"]; ?><br><?php echo $clientInfo["Adresse_client"]; ?><br></p>
                <p><?php echo $clientInfo["Telephone_client"]; ?></p>
            </div>
            <div class="invoice-producer">
                <h2>Producteur</h2>
                <p><?php echo $clientInfo["Nom_producteur"] . " " . $clientInfo["Prenom_producteur"]; ?><br><?php echo $clientInfo["Adresse_producteur"]; ?><br><?php echo $clientInfo["Telephone_producteur"]; ?></p>
            </div>
        </section>
        <section class="order-information">
            <div class="info-title">Informations sur la commande</div>
            <div class="info-detail">
            <span>Date de commande: <strong><?php echo $clientInfo["Date_commande"]; ?></strong></span>
            <span>Mode de retrait: <strong>Site</strong></span>
            <span>Numéro de la commande: <strong><?php echo $_GET["id_commande"]; ?></strong></span>
            </div>
            <div class="info-detail" id="date_retrait">
                <span>Date de retrait: <strong><?php echo $clientInfo["Date_retrait_commande"]; ?></strong></span>
            </div>
        </section>
        <?php endif; ?>
        
    <section section class="invoice-body">
    <div class="info-title" id="detail">Détails de la commande</div>
    <table class="invoice-table">
    <thead>
        <tr>
            <th>Code du produit</th>
            <th>Nom du produit</th>
            <th>Quantité commandé</th>
            <th>Quantité restante</th>
            <th>Prix unitaire</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php $info_commandes = donne_info_commande($_GET["id_commande"]);
            foreach($info_commandes as $info_commande){ 
                $class = ($info_commande["Quantite_article"] < $info_commande["Quantite_alerte_produit"]) ? 'class="alert"' : '';?>
        <tr>
            <td><?php echo $info_commande["Id_produit"];?> €</td>
            <td><a href="index.php?action=produit&id_produit=<?php echo $info_commande["Id_produit"];?>"><?php echo $info_commande["Nom_produit"];?></a></td>
            <td><?php echo $info_commande["Quantite_article"];?></td>
            <td <?php echo $class; ?>><?php echo $info_commande["Quantite_produit"];?></td>
            <td><?php echo $info_commande["Prix_produit"];?> €</td>
            <td><?php echo $info_commande["Quantite_article"]*$info_commande["Prix_produit"];?> €</td>
        </tr>
        </tbody>
            <?php }?>
    </table>
    
    </section>
    <div id="conteneur_btn">
        <a id="accueil" href="index.php?action=accueil">Retourner a l'accueil</a>
        <button id="saveButton" onclick="save_pdf()">Enregistrer</button>
    </div>
    
    <script src="lib/scripts/commande/commande.js"></script>
</body>
</html>