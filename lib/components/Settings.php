<link rel=stylesheet href="styles/components/settings.css">
<script src="lib/scripts/components/settings.js"></script>
<?php
require_once('lib/components/Input.php');
require_once('lib/database/Database.php');

function getSettings(){
    $fields = getFields();
    $html = "<div class='div-title'>";
    $html .= "<h1 class='title-settings'>Paramètres</h1>";
    $html .= "<div><img id='profilePictureImgSettings' src='".$_SESSION["image"]."' alt='Image de profil'>";
    $html .= "
    <form id='profilePictureFormSettings' action='lib/account/changeProfilePicture.php' method='POST' enctype='multipart/form-data'>
        <input type='file' name='newProfilePicture' id='profilePictureInputSettings' accept='image/png, image/jpeg' style='display:none;'>
        <input type='submit' value='profil_picture_change' style='display:none;'>
    </form></div>";
    $html .= "</div>";
    $html .= "<form class='form-settings' method='post'>";
    foreach($fields as $field){
        $html .= getInput(name: $field['name'], type: $field['type'], labelName: $field['labelName'], class: 'field', placeholder: $field['placeholder'], value: $field['value'], divClass: $field['divClass']);
    }
    $html.= "<div class='div-password'>";
    $html .= "<div class='div-input-half'>";
    $html .= "<label for='new_password'>Nouveau mot de passe</label>";
    $html .= "<input type='password' name='new_password' id='password' class='field' placeholder='Nouveau mot de passe'>";
    $html .= "</div>";
    $html .= "<div class='div-input-half'>";
    $html .= "<label for='confirm_password'>Confirmation</label>";
    $html .= "<input type='password' name='confirm_password' id='password' class='field' placeholder='Confirmation du nouveau mot de passe'>";
    $html .= "</div>";
    $html .= "</div>";
    $html .= "<div class='div-submit'>";
        $html .= "<input type='submit' name='submit' value='Valider' class='btn-submit'>";
        $html .= "<input type='submit' name='submit' value='Annuler' class='btn-cancel'>";
    $html .= "</div>";
    $html .= "</form>";
    return $html;
}
        
function getFields(){
    
    $db_instance = Database::getInstance();

    // Get the PDO connection from the instance
    $pdo = $db_instance->getConnection();
    $sql = "SELECT * FROM COMPTE WHERE Adresse_email_compte = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $fields = array();
    $fields[] = array(
        'name' => 'firstname',
        'type' => 'text',
        'labelName' => 'Prénom',
        'placeholder' => 'Prénom',
        'value' => $user['Prenom_compte'],
        'divClass' => 'div-input-half'
    );
    $fields[] = array(
        'name' => 'name',
        'type' => 'text',
        'labelName' => 'Nom',
        'placeholder' => 'Nom',
        'value' => $user['Nom_compte'],
        'divClass' => 'div-input-half'
    );
    $fields[] = array(
        'name' => 'email',
        'type' => 'email',
        'labelName' => 'Email',
        'placeholder' => 'Email',
        'value' => $user['Adresse_email_compte'],
        'divClass' => 'div-input-max'
    );
    $fields[] = array(
        'name' => 'address',
        'type' => 'text',
        'labelName' => 'Adresse',
        'placeholder' => 'Adresse',
        'value' => $user['Adresse_postal_compte'],
        'divClass' => 'div-input-max'
    );
    $fields[] = array(
        'name' => 'phone',
        'type' => 'tel',
        'labelName' => 'Numéro de téléphone',
        'placeholder' => 'Téléphone',
        'value' => $user['Num_tel_compte'],
        'divClass' => 'div-input-half'
    );
    $fields[] = array(
        'name' => 'postal_code',
        'type' => 'text',
        'labelName' => 'Code postal',
        'placeholder' => 'Code postal',
        'value' => $user['Code_postal_compte'],
        'divClass' => 'div-input-half'
    );
    if ($user['Id_role'] == 2) {
        $fields[] = array(
            'name' => 'siret',
            'type' => 'text',
            'labelName' => 'Numéro de Siret',
            'placeholder' => 'Siret',
            'value' => $user['Num_siret_producteur'],
            'divClass' => 'div-input-half'
        );
    }
    return $fields;
}