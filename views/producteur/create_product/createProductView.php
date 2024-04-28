<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">    <meta charset="UTF-8">
    <link rel="stylesheet" href="views\producteur\create_product\creationProduitView.css">
    <meta charset="UTF-8">
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
<script src="views\producteur\create_product\creationProduitView.js" defer></script>



    
    <div id="creation_produit">
    
    
    <form id="creation_produit_form" method="post" enctype="multipart/form-data">

        <div class="left-content">

        <p id="productDisplay">Nom du produit</p>

        

        <input type="hidden" name="imagePath" id="imagePath">
        <div class="image-container">
            <img src="images/produit/carotte.jpg" alt="Image du produit" id="productImage">
            <input type="file" name="productImage" id="imageInput" style="display: none;" accept="image/*">
            <button class="edit-button" type="button">✏️</button>
        </div>
            
        </div>

        <div class="right-content">

        
            <label for="productName">Nom du produit</label>
            <input type="text" name="productName" id="productName" oninput="updateProductDisplay()" required>

            <label for="productCategory">Catégorie</label>
            <select id="productCategory" name="productCategory">
                <option value="viandes" selected>viandes</option>
                <option value="poisson" selected>poisson</option>
                <option value="produit laitier" selected>produit laitier</option>
                <option value="poisson" selected>fruits et légumes</option>
                <option value="céréale" selected>céréale</option>
                <option value="vin" selected>vin</option>
                <option value="pain" selected>pain</option>
                <option value="fromage" selected>fromage</option>
                <option value="pâtisserie" selected>pâtisserie</option>
            </select>

            <label for="productPrice">Prix</label>
            <div class="price-container">
                <input type="text" id="productPrice" name="productPrice" required>

                <select id="productUnit" name="productUnit">
                    <option value="Kg/l" selected>Kg/l</option>
                    <option value="Pièce" selected>Pièce</option>
                </select>
            </div>

            <label for="productDescription">Description</label>
            <textarea id="productDescription" name="productDescription" rows="4" placeholder="Description ..." required></textarea>
            
            <div class="stock-container">
                <div class="input-group">
                    <label for="stockNumber">Nombre en stock</label>
                    <div class="quantity-control">
                        <input type="text" id="stockNumber" name="stockNumber" value="0" oninput="validateInput(this)" required>
                        <button type="button" onclick="decrement('stockNumber')">-</button>
                        <button type="button" onclick="increment('stockNumber')">+</button>
                    </div>
                </div>
                <div class="input-group">
                    <label for="stockNumberAlert">Alerte stock</label>
                    <div class="quantity-control">
                        <input type="text" class="stock-alert-input" id="stockNumberAlert" name="stockNumberAlert" value="0" oninput="validateInput(this)">
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
            <a href="index.php?action=inventory">  Annuler  </a>
            <button type="submit" name="submitForm">Créer</button>
        </div>
        </div>
        </form>
    </div>

</body>
</html>