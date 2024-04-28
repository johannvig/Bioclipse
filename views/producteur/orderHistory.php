<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500&display=swap">
    <script src="lib/scripts/producteur/orderHistory.js" ></script>
    <meta charset="UTF-8">
    <link rel=stylesheet href="styles/components/table.css">
    <script src='lib/scripts/components/table.js'></script>
    <link rel="stylesheet" href="styles/producer/orderHistory.css">
    <meta http-equiv="Content-Type: text/html" content="charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
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
        <div id="myModalStatut" class="modal">
            <div class="modal-content">
                <form method="post" id="statusForm">
                    <p id="statusChangePrompt">Changer le statut de la commande n°</p>
                    <input type="hidden" name="commandId" id="commandIdInput">
                    <select name="status" id="statusSelect">
                        <option value="validé">Validé</option>
                        <option value="en création">En création</option>
                        <option value="recuperer">Récupéré</option>
                        <option value="en attente">En attente</option>
                        <option value="annuler">Annuler</option>
                    </select>
                    <input type="submit" value="Soumettre" />
                </form>
            </div>
        </div>
    </div>
</body>

</html>