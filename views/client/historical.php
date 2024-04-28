<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">
    <link rel=stylesheet href="styles/components/table.css">
    <script src='lib/scripts/components/table.js'></script>
    <link rel="stylesheet" href="styles/client/historical.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioclipse</title>
</head>

<body>
    <?= $left_panel ?>
    <div class='right-div'>
        <h2>Historique des commandes</h2>
        <?php if (isset($table)) : ?>
            <?= $table ?>
        <?php else : ?>
            <div class='no-results'>Aucune commande effectuée</div>
        <?php endif; ?>
    </div>
</body>

</html>