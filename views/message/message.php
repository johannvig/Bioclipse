<?php
if (!isset($_SESSION["Id_compte"])) {
    header("Location: /login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/message/message.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messagerie</title>
</head>
<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <header>
            <h1>Messagerie</h1>
            <form method="post" id="search_contact">
                <input id="search_bar" type="text" name="search_contact" placeholder="Rechercher un nouveau contact">
                <input id="search_btn" type="submit" name="submit_search" value="&#x1F50D">
            </form>
            <?php if (isset($search_results) && !empty($search_results)): ?>
                <div id="search-results">
                    <?php foreach ($search_results as $account): ?>
                        <div class="search-result">
                            <form method="post">
                                <input type="hidden" name="add_contact_id" value="<?php echo htmlspecialchars($account['Id_compte']); ?>">
                                <input class="nom" type="submit" name="add_contact" value="<?php echo htmlspecialchars($account['Nom_compte']." ".$account["Prenom_compte"]); ?>">
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div id="containeur">
        <?php
            $results = affiche_correspondant();
            foreach($results as $result){?>
                <a href='index.php?action=messagerie&correspondant= <?php echo htmlspecialchars($result["id_groupe"]); ?>' class="containeur_groupe">
                    <img class="profil" src="<?php echo htmlspecialchars($result["image_groupe"]);?>" alt="">
                    <div class="titre_message">
                        <h4><?php echo htmlspecialchars($result['Nom_groupe']); ?></h4>
                        <p><?php $message = affiche_message_dernier($result["id_groupe"]);
                            if (!empty($message)) {
                                $contenu_message = $message[0]['Contenu_message'];
                                $message_tronque = substr($contenu_message, 0, 51);

                                if (strlen($contenu_message) > 51) {
                                    $message_tronque .= '...'; 
                                }

                                echo htmlspecialchars($message_tronque);
                            }
                            ?></p>
                    </div>
                </a>
                <div class="bar_separation"></div>    
            <?php }?>
            </div>
            <a href="index.php?action=accueil" id="accueil">Retour a l'accueil</a>
    </header>
    <div id=page>
        <div id="header">
            <?php 
                if(!isset($_GET["correspondant"])){
                    ?><h1>Bienvenue sur votre messagerie</h1><?php
                }
                else{
                    $info_groupes = info_groupe($_GET["correspondant"]);
                    foreach($info_groupes as $info_groupe){?>
                <div id="nom_photo"><img src="<?php echo htmlspecialchars($info_groupe["image_groupe"]);?>">
                <h1><?php echo htmlspecialchars($info_groupe["nom_groupe"]);?></h1></div>
                    <button id="groupe">&#x2699;</button>
                
                <?php }
                }?>
        </div>
        <div id="message">
        </div>
        <script>
            var correspondantId = <?php echo htmlspecialchars($_GET["correspondant"]); ?>;
            setInterval(load_message, 1000);

            function load_message(){
                console.log("Je passe");
                if(correspondantId) {
                    $('#message').load('models/message/load_message.php?correspondant=' + correspondantId);
                }
            }
            window.onload = function() {
                var messageContainer = document.getElementById("message");
                messageContainer.scrollTop = messageContainer.scrollHeight;
            }
            load_message();
        </script>
        <?php if(isset($_GET["correspondant"])){
            ?><footer>
            <div id="bar_message">
                <form action="" method="post">
                    <input type="text" name="message" id="write_message" placeholder="Envoyer un message">
                    <button type="submit" id="send_message" name="send_message">&#x27A4</button>
                </form>
            </div>
        </footer>
        <?php
        }?>
        
    </div>
    <!-- Modal -->
    <?php if (isset($_GET["correspondant"])) {?>
        <div id="bandeDroite" class="bande-cachee"> <?php 
        }else{?>  
            <div id="bandeDroite" class="bande-affichee">
            <?php }?>
        <div id="headerBandeDroite">
            <h2>Group Settings</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" id="groupId" name="groupId" value="<?php echo htmlspecialchars($_GET["correspondant"]);?>">
                <div class="update_groupe">
                    <input type="text" id="groupTitle" name="groupTitle" placeholder="Entrer votre nouveau titre">
                    <input type="file" id="groupImage" name="groupImage" placeholder="Choissez votre image">
                    <input type="submit" name="updateSettings" id="updateSettings" value="Enregistrer">
                </div>
            </form>
            <form method="post" id="search_contact_add">
                <input id="search_bar_add" type="text" name="search_bar_add" placeholder="Rechercher un contact">
                <input id="search_btn_add" type="submit" name="submit_search_add" value="&#x1F50D">
            </form>
                <?php if (isset($search_results_add) && !empty($search_results_add)): ?>
                    <div id="search_results_add">
                        <?php foreach ($search_results_add as $account): ?>
                            <div class="search_results_add">
                                <form method="post">
                                    <input type="hidden" name="add_contact_id" value="<?php echo htmlspecialchars($account['Id_compte']); ?>">
                                    <input class="nom" type="submit" name="add_contact_groupe" value="<?php echo htmlspecialchars($account['Nom_compte']." ".$account["Prenom_compte"]); ?>">
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php $nom_correspondant_groupes = nom_correspondant_groupes($_GET["correspondant"]);
                ?><div id="liste_nom">
                        <h3>Liste de participant :</h3><?php
                            foreach($nom_correspondant_groupes as $nom_correspondant_groupe){?>
                                <h4 id="nom_prenom"> - <?php echo htmlspecialchars($nom_correspondant_groupe["nom_compte"]);?>
                            <?php echo htmlspecialchars($nom_correspondant_groupe["prenom_compte"]);?></h4>
                        <?php }?>
                    </div>
        </div>
        <form method="post" id="exit">
            <input type="submit" id="exit_group" name="exit_group" value="Quitter le groupe">
        </form>
    </div>       
    <script src="lib/scripts/messagerie/messagerie.js"></script>
</body>
</html>


