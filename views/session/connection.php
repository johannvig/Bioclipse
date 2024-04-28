<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles/session/connection.css">
    <link rel="stylesheet" href="styles/components/notification.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="lib/scripts/components/notification.js"></script>
    <title>Bioclipse</title>
</head>

<body>
    <div id="right">
        <?php
        if (isset($_GET["error"]) && $_GET["error"]) {
            require_once("lib/components/notification.php");
            if ($_GET["error"] == "incorrect_credentials")
                echo (createNotification("error", "Identifiants incorrects", 5000));
            if ($_GET["error"] == "not_validated")
                echo (createNotification("success", "Votre compte n'a pas encore été validé", 5000));
        }
        ?>
        <button onclick="window.location.href = 'index.php';">
            <svg width="30" height="30" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="21.6667" cy="21.6667" rx="21.6667" ry="21.6667" transform="matrix(-1 0 0 1 45.166 1.83325)" stroke="black" stroke-width="2.08134" stroke-linejoin="round" />
                <path d="M28.2393 13.3437C24.0086 17.5744 21.6366 19.9464 17.4059 24.177L28.2393 35.0104" stroke="black" stroke-width="2.08134" stroke-linejoin="round" />
            </svg>
        </button>
        <div class="div-connection">
            <div class="div-title">
                <h1><?= $title ?></h1>
                <div class="div-choice">
                    <button id="btn-choiced" onclick="window.location.href = 'index.php?action=login';">Connexion</button>
                    <button onclick="window.location.href = 'index.php?action=registration';">Inscription</button>
                </div>
            </div>
            <form action="lib/database/connect.php" method="post">
                <?php
                foreach ($inputs as $input) {
                    echo ($input);
                }
                echo ($submit);
                ?>
            </form>
        </div>
    </div>
</body>

</html>