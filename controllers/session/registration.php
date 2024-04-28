<?php

function registration()
{
    require('models/session/registration.php');

    $title = title();
    $inputs_account = inputs_account();
    $inputs_producer = inputs_producer();
    $paragraph = paragraph();
    $checkbox_is_producer = checkbox_is_producer();
    $submit = submit();
    $action = action();

    require('views/session/registration.php');
}
