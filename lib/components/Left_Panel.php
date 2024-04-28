<?php

function getLeftPanel($buttons)
{
    $html = '
    <link rel=stylesheet href="styles/components/left_panel.css">
    <link rel=stylesheet href="https://fonts.googleapis.com/css?family=Poppins">
    <script src="lib/scripts/components/leftPanel.js"></script>
    <div class="div-top">
    <div class="div-home">
    <div class="div-return">
        <button class="btn-home" onclick="location.href=' . "'index.php?action=accueil'" . '">
                <svg width="30" height="30" viewBox="0 0 47 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <ellipse cx="21.6667" cy="21.6667" rx="21.6667" ry="21.6667" transform="matrix(-1 0 0 1 45.166 1.83325)" stroke="black" stroke-width="2.08134" stroke-linejoin="round" />
                    <path d="M28.2393 13.3437C24.0086 17.5744 21.6366 19.9464 17.4059 24.177L28.2393 35.0104" stroke="black" stroke-width="2.08134" stroke-linejoin="round" />
                </svg>
        </button>
    </div>
    <div class="div-logo">
        <img class="img-logo" src="images/logo.png" alt="Logo">
    </div>
    </div>';
    $html .= '<div class="div-buttons">';
    foreach ($buttons as $button) {
        $html .= $button;
    }
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="div-bottom">';
    $html .= getDivUser();
    $html .= getActions();
    $html .= '</div>';
    return '
    <nav class="left-panel">
    ' . $html . '
    </nav>';
}
// attention mettre un index.php?action=
function getButton($params)
{
    return '
    <button class="btn-panel ' . $params["class"] . '" onclick="location.href=\'' . $params['url'] . '\'">
        <div class="div-img">
            <img class="button-img" src="' . $params['img'] . '" alt="' . $params['alt'] . '">
        </div>
        <p>' . $params['text'] . '</p>
        <div class="div-arrow">
            <img class="arrow" src="images/components/right_arrow' . ($params["class"] != "" ? "_white" : "") . '.svg" alt="Flèche">
        </div>
    </button>
    ';
}

function getDivUser()
{
    $html = '
    <div class="div-user">
        <div class="div-img-user">
            <img class="img-user" id="profilePictureImg" src="' . $_SESSION["image"] . '" alt="Image de profil">
            <form id="profilePictureForm" action="lib/account/changeProfilePicture.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="newProfilePicture" id="profilePictureInput" accept="image/png, image/jpeg" style="display:none;">
                <input type="submit" value="profil_picture_change" style="display:none;">
            </form>
        </div>
        <div class="div-name-user">
            <p class="name-user">' . $_SESSION["name"] . ' ' . $_SESSION["surname"] . '</p>
            <p class="role-user">' . $_SESSION["role"] . '</p>
        </div>
    </div>';
    return $html;
}

function getActions()
{
    return '
    <div class="div-actions">
        <div class="a-action">
            <a class="a-action" href="lib/account/logout.php" id="btn_logout"><img class="img-action" src="images/components/logout.svg" alt="">Déconnexion</a>
        </div>
        <div class="a-action">
            <a class="a-action" href="lib/database/delete_account.php?email='.$_SESSION["email"].'" id="btn_sup"><img class="img-action" src="images/components/delete.svg" alt="">Supprimer le compte</a>
        </div>
    </div>
    ';
}
