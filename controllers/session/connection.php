<?php

function connection(){
    require ('models/session/connection.php');

    $title = title();
    $inputs = inputs();
    $submit = submit();

    require ('views/session/connection.php');
}



