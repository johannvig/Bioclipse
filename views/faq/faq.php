<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/faq/faq.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">  
    <title>F.A.Q</title>
</head>
<body>

    <div id="intro">
        <h1> Bonjour
            <?php
                if(isset($_SESSION["Id_compte"])){
                    echo $_SESSION['surname']." ";
                    echo $_SESSION['name'];
                }else{
                    echo "visiteur venu d'ailleurs";
                }
                
            ?> 
        </h1>
        <p> Une question ?</p>
        <p> Une réponse </p>
    </div>
    
    <div id='question'>
        <div class="card">
            <h2>Comment l'application traite-t-elle les aspects liés à la sécurité et à la confidentialité ?</h2>
            <p>L'application respecte les normes de sécurité et de confidentialité en vigueur.</p>
        </div>
        <div class="card">
            <h2>Quel est l'objectif principal de Bioclipse ?</h2>
            <p>Notre but est de promouvoir les producteurs locaux et faciliter la liaison entre clients et 
                producteurs pour encourager une consommation locale.</p>
        </div>
        <div class="card">
            <h2>Qui peut utiliser l'application Bioclipse ?</h2>
            <p>L'application est accessible à tous pour peu que vous ayez des producteurs près de chez vous.</p>
        </div>
        <div class="card">
            <h2>Les producteurs ont-ils le contrôle sur leurs offres dans l'application ?</h2>
            <p>Oui, les producteurs peuvent ajouter, modifier ou supprimer leurs offres, 
                et ont également la possibilité de gérer les stocks et les commandes.</p>
        </div>
        <div class="card">
            <h2>L'application offre-t-elle des fonctionnalités de filtrage et de recherche ?</h2>
            <p>Oui, l'application permet de filtrer et de rechercher des produits et des producteurs selon divers critères.</p>
        </div>
        <div class="card">
            <h2>Comment l'application gère-t-elle la communication entre utilisateurs ?</h2>
            <p>Elle intègre une fonction de messagerie pour faciliter la communication directe entre producteurs, 
                clients et administrateurs.</p>
        </div>
    </div>

    <div id="fin">
        <h1> Nous n'avons pas pu répondre a vos questions ? </h1>
        <p> Posez nous la question par mail : <a href="mailto:bioclipse@gmail.com"> bioclipse@gmail.com </a> </p>
    </div>

</body>
</html>