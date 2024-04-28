<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">
    <meta charset="UTF-8">
    <link rel=stylesheet href="styles/components/table.css">
    <script src='lib/scripts/components/table.js'></script>
    <link rel="stylesheet" href="styles/producer/inventory.css">
    <link rel="stylesheet" href="styles/components/left_panel.css">

    <meta http-equiv="Content-Type: text/html" content="charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta charset="UTF-8">

    <title>Bioclipse</title>
</head>

<body>
    <?= $left_panel ?>
    <div class='right-div'>
        <h2>Inventaire</h2>
        <a id="nouveau-produit" href="index.php?action=create_product">
            <p>Nouveau Produit</p>
            <img id="add-logo" src="images/producteur/add.png" alt="Add logo" width=17px height=17px>
        </a>
        <?php if (isset($table)) : ?>
            <?= $table ?>
        <?php else : ?>
            <div class='no-results'>Aucun produit dans votre inventaire</div>
        <?php endif; ?>
    </div>
</body>

</html>