<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins'>
    <link rel=stylesheet href="styles/components/table.css">
    <script src='lib/scripts/components/table.js'></script>
    <link rel=stylesheet href="styles/administrator/producers.css">
    <link rel=stylesheet href="styles/components/left_panel.css">
    <title>Bioclipse</title>
</head>

<body>
    <?= $left_panel ?>
    <div class='right-div'>
        <div class="div-table">
            <div class="head">
                <h2>Producteurs en attente de validation</h2>
                <div>
                    <div class="contact-btn">
                        <a href="index.php?action=admin_producteurs&create_group=producers">
                            <p>Contacter les producteurs</p>
                        </a>
                    </div>
                    <div class="contact-btn">
                        <a href="index.php?action=admin_producteurs&create_group=clients">
                            <p>Contacter les clients</p>
                        </a>
                    </div>
                </div>
            </div>
            <?php if (isset($table_validation)) : ?>
                <?= $table_validation ?>
            <?php else : ?>
                <div class='no-results'>Il n'y a aucun producteur en attente de validation de votre part</div>
            <?php endif; ?>
        </div>
        <div class="div-table">
            <h2>Producteurs validés</h2>
            <?php if (isset($table_producers)) : ?>
                <?= $table_producers ?>
            <?php else : ?>
                <div class='no-results'>Il n'y a aucun producteur validé</div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>