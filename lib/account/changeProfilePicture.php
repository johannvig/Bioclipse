<?php

session_start();
$info = pathinfo(htmlspecialchars($_FILES['newProfilePicture']['name'], ENT_QUOTES, 'UTF-8'));
$ext = $info['extension'];
if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
    $ext = "png";
} else {
    $error = "format";
    header("Location: ../../index.php?action=compte&error=$error");
    exit();
}
$name = $_SESSION["Id_compte"] . "." . $ext;
$target = "../../images/profil_pic/" . $name;
move_uploaded_file($_FILES['newProfilePicture']['tmp_name'], $target);

require_once("../database/Database.php");
$conn = Database::getConnection();
$sql = "UPDATE COMPTE SET image_compte = 'images/profil_pic/$_SESSION[Id_compte].$ext' WHERE Id_compte = " . $_SESSION["Id_compte"];
$conn->query($sql);
$_SESSION["image"] = "images/profil_pic/$_SESSION[Id_compte].$ext";
header("Location: ../../index.php?action=compte");
