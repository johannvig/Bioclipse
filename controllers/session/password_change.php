<?php

function password_change()
{
    require('models/session/password_change.php');
    $error = "";
    if (isset($_GET["token"]) && isset($_POST["new_password"]) && isset($_POST["new_password_confirm"])) {
        if (htmlspecialchars($_POST["new_password"], ENT_QUOTES, 'UTF-8') == htmlspecialchars($_POST["new_password_confirm"], ENT_QUOTES, 'UTF-8')) {
            $error = changePassword(htmlspecialchars($_GET["token"], ENT_QUOTES, 'UTF-8'), htmlspecialchars($_POST["new_password"], ENT_QUOTES, 'UTF-8'));
        } else {
            $error = "passwords_dont_match";
        }
    }
    $title = title();
    $inputs = inputs();
    $paragraph = paragraph();
    $submit = submit();
    $action = action();

    require('views/session/password_change.php');
}
