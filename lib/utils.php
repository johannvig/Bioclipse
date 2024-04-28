<?php

use PHPMailer\PHPMailer\PHPMailer;

function hashPassword($password)
{
    return hash('sha256', $password);
}

function checkPassword($password, $hashedPassword)
{
    return hashPassword($password) == $hashedPassword;
}

function sendEmail($clientEmail)
{
    $clientEmail = htmlspecialchars($clientEmail, ENT_QUOTES, 'UTF-8');
    require_once ('lib/database/Database.php');
    $token = bin2hex(random_bytes(32));
    $db_instance = Database::getInstance();

    // Get the PDO connection from the instance
    $pdo = $db_instance->getConnection();
    $stmt = $pdo->prepare("SELECT Id_compte FROM COMPTE WHERE Adresse_email_compte = :email");
    $stmt->bindParam(':email', $clientEmail);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        $error = 'email_not_found';
        return $error;
    }
    $id_compte = $row["Id_compte"];
    // Récupérer le token de connexion depuis la base de données
    $stmt = $pdo->prepare("INSERT INTO AUTHENTIFICATION VALUES (:token_connexion, :id_compte)");
    $stmt->bindParam(':id_compte', $id_compte);
    $stmt->bindParam(':token_connexion', $token);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Configurer PHPMailer
    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'bioclipse53@gmail.com';
    $mail->Password = 'quna pjug jcqs lfjo';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('bioclipse53@gmail.com', 'Bioclipse');
    $mail->addAddress($clientEmail);
    $mail->isHTML(true);

    $lien = 'https://ewenbuhot.fr/Bioclipse/index.php?action=password_change&token=' . $token;
    $mail->Subject = 'Changement de votre mot de passe';
    $mail->Body    = 'Bonjour, veuiller changer votre mot de passe en suivant ce <a href="' . $lien . '">lien</a>.';

    if (!$mail->send()) {
        $error = 'message_not_sent';
    } else {
        $error = 'message_sent';
    }
    return $error;
}
