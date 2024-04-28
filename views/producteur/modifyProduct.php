<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">    
<link rel="stylesheet" href="views\producteur\modify_product\modifyProductView.css">
<meta http-equiv="Content-Type: text/html" content="charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bioclipse</title>
</head>
<body>
<header>
        <div id="navBar">
            <div id="logo">
                    <img src="images/logo.png" alt="">
            </div>
            <nav>
                <p >Accueil</p>
                <p >Produits</p>
                <p >Panier</p>
                <p >Favoris</p>
            </nav>
            <div id="conteneurbtn">
            
                    <p >Se connecter</p>
                
            </div>
        </div>
    </header>

<a href="index.php?action=inventory" id="retour">
    <img src="images/producteur/back-button.png" alt="Retour" width="35px" height="35px"/>
</a>

<script src="views\producteur\modify_product\modifyProductView.js" defer></script>

<?php 

    $product = getProductInfo($productId);

    $nomProduit = isset($product['Nom_produit']) ? $product['Nom_produit'] : 'Nom inconnu';
    $imageProduit = isset($product['Image_produit']) ? $product['Image_produit'] : 'images/produit/carotte.jpg';
    $categorieProduit = isset($product['Categorie_produit']) ? $product['Categorie_produit'] : 'viandes';
    $prixProduit = isset($product['Prix_produit']) ? $product['Prix_produit'] : 0;
    $uniteProduit = isset($product['Unite_produit']) ? $product['Unite_produit'] : 'Kg/l';
    $descProduit = isset($product['Desc_produit']) ? $product['Desc_produit'] : '';
    $quantiteProduit = isset($product['Quantite_produit']) ? $product['Quantite_produit'] : 0;
    $quantiteAlerteProduit = isset($product['Quantite_alerte_produit']) ? $product['Quantite_alerte_produit'] : 0;

    if ($product): ?>



<div id="creation_produit">


<form id="update_produit_form" method="post" enctype="multipart/form-data">

    <div class="left-content">

    <p id="productDisplay">Nom du produit</p>

    

    <input type="hidden" name="imagePath" id="imagePath">
    <div class="image-container">
        <img src="<?php echo $imageProduit;?>" alt="Image du produit" id="productImage">
        <input type="file" name="productImage" id="imageInput" style="display: none;" accept="image/*">
        <button class="edit-button" type="button">✏️</button>
    </div>
        
    </div>

    <div class="right-content">

    
        <label for="productName">Nom du produit</label>
        <input type="text" name="productName" id="productName" oninput="updateProductDisplay()" required value="<?php echo $nomProduit; ?>">

        <label for="productCategory">Catégorie</label>
        <select id="productCategory" name="productCategory">
            <option value="viandes" <?php echo $categorieProduit == 'viandes' ? 'selected' : ''; ?>>viandes</option>
            <option value="poisson" <?php echo $categorieProduit == 'poisson' ? 'selected' : ''; ?>>poisson</option>
            <option value="produit laitier" <?php echo $categorieProduit == 'produit laitier' ? 'selected' : ''; ?>>produit laitier</option>
            <option value="fruits et légumes" <?php echo $categorieProduit == 'fruits et légumes' ? 'selected' : ''; ?>>fruits et légumes</option>
            <option value="céréale" <?php echo $categorieProduit == 'céréale' ? 'selected' : ''; ?>>céréale</option>
            <option value="vin" <?php echo $categorieProduit == 'vin' ? 'selected' : ''; ?>>vin</option>
            <option value="pain" <?php echo $categorieProduit == 'pain' ? 'selected' : ''; ?>>pain</option>
            <option value="fromage" <?php echo $categorieProduit == 'fromage' ? 'selected' : ''; ?>>fromage</option>
            <option value="pâtisserie" <?php echo $categorieProduit == 'pâtisserie' ? 'selected' : ''; ?>>pâtisserie</option>
        </select>

        <label for="productPrice">Prix</label>
        <div class="price-container">
            <input type="text" id="productPrice" name="productPrice" required value="<?php echo $prixProduit; ?>">

            <select id="productUnit" name="productUnit">
                <option value="Kg/l" <?php echo $uniteProduit == 'Kg/l' ? 'selected' : ''; ?>>Kg/l</option>
                <option value="Pièce" <?php echo $uniteProduit == "Pièce" ? 'selected' : ''; ?>>Pièce</option>
            </select>
        </div>

        <label for="productDescription">Description</label>
        <textarea id="productDescription" name="productDescription" rows="4" placeholder="Description ..." required><?php echo $descProduit; ?></textarea>

        <div class="stock-container">
        <div class="input-group">
            <label for="stockNumber">Nombre en stock</label>
            <div class="quantity-control">
                <input type="text" id="stockNumber" name="stockNumber" oninput="validateInput(this)" required value="<?php echo $quantiteProduit; ?>">
                <button type="button" onclick="decrement('stockNumber')">-</button>
                <button type="button" onclick="increment('stockNumber')">+</button>
            </div>
        </div>
        <div class="input-group">
            <label for="stockNumberAlert">Alerte stock</label>
            <div class="quantity-control">
                <input type="text" id="stockNumberAlert" name="stockNumberAlert" oninput="validateInput(this)" value="<?php echo $quantiteAlerteProduit; ?>">
                <button type="button" onclick="decrement('stockNumberAlert')">-</button>
                <button type="button" onclick="increment('stockNumberAlert')">+</button>
            </div>
        </div>
        <div class="info-container">
            <img src="images\producteur\information.png" alt="Info" class="info-icon" width="21px" height="21px"/>
            <div class="popup" id="infoPopup">
                <p>Cette option permet de recevoir de savoir lorsque le stock d'un produit est en dessous du seuil d'alerte afin de remettre le produit en stock. 
                    Vous serez averti via le bon de commande des clients avec une alerte à côté du produit qui est sous le seuil.
                </p>
            </div>
        </div>

    </div>

    

    <div class="button-container">
        
        <button type="submit" name="submitForm">Mettre à jour</button>
    </div>
    </div>
    </form>
</div>
<button id="myBtn">  Supprimer  </button>
<?php else: ?>
        <p>Produit non trouvé.</p>
    <?php endif; ?>


<!-- Pop up supprimer produit -->


<form id="delete_produit_form" method="post" enctype="multipart/form-data">
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Êtes-vous sûr de vouloir supprimer votre produit ?</h3>
                <span class="close">&times;</span>
            </div>
            <div class="modal-footer">
                <button id="btnAnnuler" class="modal-btn">Annuler</button>
                <button id="btnSupprimer" class="modal-btn delete" type="submit" name="deleteProduct">Supprimer</button>
            </div>
        </div>
    </div>
</form>


</body>
</html>