<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles/session/registration.css">
    <link rel="stylesheet" href="styles/components/notification.css">
    <script language="javascript" src="lib/scripts/registration.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioclipse</title>
</head>

<body>
    <?php
    if (isset($_GET["error"]) && $_GET["error"]) {
        require_once("lib/components/notification.php");
        if ($_GET["error"] == "empty_fields")
            echo (createNotification("error", "Veuillez remplir tous les champs", 5000));
        if ($_GET["error"] == "passwords_dont_match")
            echo (createNotification("error", "Les mots de passe ne correspondent pas", 5000));
        if ($_GET["error"] == "email_already_used")
            echo (createNotification("error", "Cette adresse email est déjà utilisée", 5000));
        if ($_GET["error"] == "phone_already_used")
            echo (createNotification("error", "Ce numéro de téléphone est déjà utilisé", 5000));
    }
    ?>
    <div id="right">
        <button onclick="window.location.href = 'index.php'">
            <svg width="30" height="30" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="21.6667" cy="21.6667" rx="21.6667" ry="21.6667" transform="matrix(-1 0 0 1 45.166 1.83325)" stroke="black" stroke-width="2.08134" stroke-linejoin="round" />
                <path d="M28.2393 13.3437C24.0086 17.5744 21.6366 19.9464 17.4059 24.177L28.2393 35.0104" stroke="black" stroke-width="2.08134" stroke-linejoin="round" />
            </svg>
        </button>
        <div>
            <div class="div-title">
                <h1><?= $title ?></h1>
                <div class="div-choice">
                    <button onclick="window.location.href = 'index.php?action=login';">Connexion</button>
                    <button id="btn-choiced" onclick="window.location.href = 'index.php?action=registration';">Inscription</button>
                </div>
            </div>
            <p><?= $paragraph ?></p>
            <div class="indicator">
                <span class="line"><span></span></span>
                <p class="active">1</p>
                <p>2</p>
                <p>3</p>
                <p>4</p>
                <p>5</p>
            </div>
            <form action="lib/database/registration.php" method="post">
                <?php
                foreach ($inputs_account as $input) {
                    echo ($input);
                }
                echo('<div class="tab">');
                echo("<h2>Producteur</h2>");
                echo ($checkbox_is_producer);
                foreach ($inputs_producer as $input) {
                    echo ($input);
                }
                echo ("</div>");
                ?>
                <div class="btn">
                    <button type="button" class="prev">Précédent</button>
                    <button type="button" class="next">Suivant</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>