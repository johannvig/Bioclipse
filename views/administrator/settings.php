<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="styles/administrator/settings.css">
    <link rel=stylesheet href="styles/components/left_panel.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins'>
    <title>Bioclipse</title>
</head>

<body>
    <?= $left_panel ?>
    <div class="right-div">
        <?php
        if (isset($_GET["error"]) && $_GET["error"]) {
            require_once("lib/components/notification.php");
            if ($_GET["error"] == "email_already_used")
                echo (createNotification("error", "Cette adresse email est déjà utilisée", 5000));
            if ($_GET["error"] == "phone_already_used")
                echo (createNotification("error", "Ce numéro de téléphone est déjà utilisé", 5000));
            if ($_GET["error"] == "passwords_dont_match")
                echo (createNotification("error", "Les mots de passe ne correspondent pas", 5000));
            if ($_GET["error"] == "format")
                echo (createNotification("error", "Le format de l'image n'est pas valide", 5000));
        }
        ?>
        <?= $settings ?>
    </div>
</body>

</html>