<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles/session/password_change.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioclipse</title>
</head>

<body>
    <div id="right">
        <?php
        if (isset($error)) {
            require_once("lib/components/notification.php");
            if ($error == "account_not_found")
                echo (createNotification("error", "Token invalide", 5000));
            if ($error == "password_changed")
                echo (createNotification("success", "Votre mot de passe a bien été changé", 5000));
            if ($error == "passwords_dont_match")
                echo (createNotification("error", "Les mots de passe ne correspondent pas", 5000));
        }
        ?>
        <button onclick="window.location.href = 'index.php';">
            <svg width="30" height="30" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="21.6667" cy="21.6667" rx="21.6667" ry="21.6667" transform="matrix(-1 0 0 1 45.166 1.83325)" stroke="black" stroke-width="2.08134" stroke-linejoin="round" />
                <path d="M28.2393 13.3437C24.0086 17.5744 21.6366 19.9464 17.4059 24.177L28.2393 35.0104" stroke="black" stroke-width="2.08134" stroke-linejoin="round" />
            </svg>
        </button>
        <div class="main">
            <h1><?= $title ?></h1>
            <p><?= $paragraph ?></p>
            <form action="" method="post">
                <?php
                foreach ($inputs as $input) {
                    echo ($input);
                }
                echo ($submit);
                ?>
                <div id="aide">
                    <p>Vous avez besoins d'aide ?</p>
                    <a href="<?= $action ?>">Service client</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>