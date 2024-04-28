<?php

function password_forgotten(){
    require ('models/session/password_forgotten.php');
    require ('lib/utils.php');
    $error = "";
    if (isset($_POST["email"])){
        $error = sendEmail(htmlspecialchars($_POST["email"], ENT_QUOTES, 'UTF-8'));     
    }
    $title = title();
    $inputs = inputs();
    $paragraph = paragraph();
    $submit = submit();
    $action = action();
    
    require ('views/session/password_forgotten.php');
}



