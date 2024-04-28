use base_de_donnee_bioclipse;
-- Suppression de la procédure si elle existe déjà
DROP PROCEDURE IF EXISTS VerifierStockApresCommande;

-- Création de la procédure
DELIMITER //
CREATE PROCEDURE VerifierStockApresCommande (IN IdCommande INT)
BEGIN

    -- Déclaration d'une table temporaire pour stocker les produits en dessous de leur seuil d'alerte
    DROP TEMPORARY TABLE IF EXISTS ProduitsAlerte;
    CREATE TEMPORARY TABLE ProduitsAlerte (
        id_produit INT,
        nom_produit VARCHAR(255),
        quantite_produit INT,
        quantite_alerte_produit INT
    );

    -- Remplissage de la table temporaire
    INSERT INTO ProduitsAlerte
    SELECT 
        p.id_produit, 
        p.nom_produit, 
        p.quantite_produit, 
        p.quantite_alerte_produit
    FROM 
        PRODUIT AS p
    JOIN 
        AJOUTER AS a ON a.id_produit = p.id_produit
    WHERE 
        a.id_commande = IdCommande AND p.quantite_produit <= p.quantite_alerte_produit;

    -- Vérification de l'existence d'au moins un enregistrement
    IF (SELECT COUNT(*) FROM ProduitsAlerte) > 0 THEN
        SELECT 
            id_produit, 
            nom_produit, 
            quantite_produit, 
            quantite_alerte_produit 
        FROM 
            ProduitsAlerte;
    ELSE
        SELECT 'Tous les produits commandés sont au-dessus de leur seuil d alerte.' AS message;
    END IF;

END;
//
DELIMITER ;

-- Appel de la procédure pour tester
CALL VerifierStockApresCommande(1);



-- procédure 2 :
use base_de_donnee_bioclipse;
-- Suppression de la procédure si elle existe déjà
DROP PROCEDURE IF EXISTS CalculerMoyenneNotesPourProduit;

-- Création de la procédure
DELIMITER //
CREATE PROCEDURE CalculerMoyenneNotesPourProduit(IN ProduitID INT)
BEGIN
    -- Calcul de la moyenne des notes pour le produit spécifié
    -- L'arrondi est fait au niveau de l'entier le plus proche
    SELECT 
        id_produit, 
        ROUND(AVG(CAST(Note_avis AS DECIMAL(10, 2))), 0) AS `Moyenne des Notes Arrondie` 
    FROM 
        AVIS 
    WHERE 
        id_produit = ProduitID
    GROUP BY 
        id_produit;
END;
//
DELIMITER ;

-- Appel de la procédure pour tester
CALL CalculerMoyenneNotesPourProduit(1);
CALL CalculerMoyenneNotesPourProduit(2);


-- procédure 3 :
-- Suppression de la procédure si elle existe déjà
DROP PROCEDURE IF EXISTS SupprimerGroupe;

-- Création de la procédure
DELIMITER //
CREATE PROCEDURE SupprimerGroupe(IN identifiant_groupe INT)
BEGIN
    -- Suppression des messages associés au groupe
    DELETE FROM MESSAGE WHERE Id_groupe = identifiant_groupe;
    
    -- Suppression des affiliations associées au groupe
    DELETE FROM AFFILIER WHERE Id_groupe = identifiant_groupe;

    -- Suppression du groupe
    DELETE FROM GROUPE WHERE Id_groupe = identifiant_groupe;
END;
//
DELIMITER ;

-- Appel de la procédure pour tester
CALL SupprimerGroupe(1);
SELECT * FROM PRODUIT;


-- procédure 4

-- Suppression de la procédure si elle existe déjà
DROP PROCEDURE IF EXISTS AjouterProduit;

-- Création de la procédure
DELIMITER //
CREATE PROCEDURE AjouterProduit(
    IN p_id_compte INT,
    IN p_nom VARCHAR(100),
    IN p_description TEXT,
    IN p_prix DECIMAL(10,2),
    IN p_quantite_stock INT,
    IN p_seuil_alerte INT,
    IN p_categorie VARCHAR(50),
    IN p_unite_mesure VARCHAR(20),
    IN p_image VARCHAR(256)
)
BEGIN
    DECLARE catProducteur VARCHAR(255);

    -- Récupération de la catégorie du producteur
    SELECT Nom_categorie INTO catProducteur
    FROM CATEGORIE
    JOIN COMPTE ON CATEGORIE.id_categorie = COMPTE.id_categorie
    WHERE COMPTE.id_compte = p_id_compte;

    -- Création d'une table temporaire pour les correspondances entre catégories
    CREATE TEMPORARY TABLE CorrespondanceTable (
        CategorieProduit VARCHAR(50),
        CategorieProducteur VARCHAR(50)
    );

    -- Remplissage de la table temporaire
    INSERT INTO CorrespondanceTable VALUES
    ('poisson', 'poissonnerie'),
    ('viandes', 'boucherie'),
    ('fruits et légumes', 'maraîcher'),
    ('vin', 'viticole'),
    ('céréale', 'céréalier'),
    ('fromage', 'fromager'),
    ('produit laitier', 'laitier'),
    ('pâtisserie', 'pâtisserie'),
    ('pain', 'boulangerie');

    -- Vérification de la correspondance des catégories
    IF NOT EXISTS (SELECT 1 FROM CorrespondanceTable WHERE CategorieProduit = p_categorie AND CategorieProducteur = catProducteur) THEN
        SELECT 'La catégorie du produit ne correspond pas à la catégorie du producteur' AS ErrorMessage;
    ELSE
        INSERT INTO PRODUIT(Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit, Categorie_produit, Id_compte)
        VALUES (p_nom, p_description, p_prix, p_quantite_stock, p_seuil_alerte, p_unite_mesure, p_image, p_categorie, p_id_compte);
    END IF;

    -- Suppression de la table temporaire (optionnel)
    DROP TEMPORARY TABLE IF EXISTS CorrespondanceTable;

END;
//
DELIMITER ;

CALL AjouterProduit(18,'gateau','un gateau',15,50,10,'pâtisserie','Pièce',NULL);

SELECT * FROM PRODUIT WHERE Nom_produit ='gateau';


-- procédure 5 
use base_de_donnee_bioclipse;

-- Supprime la procédure si elle existe déjà
DROP PROCEDURE IF EXISTS SupprimerProduit;

-- Définition de la nouvelle procédure
DELIMITER //
CREATE PROCEDURE SupprimerProduit(IN IdProduit INT)
BEGIN
    -- Suppression des avis liés au produit
    DELETE FROM AVIS WHERE id_produit = IdProduit;

    -- Suppression des liaisons du produit avec les commandes
    DELETE FROM AJOUTER WHERE id_produit = IdProduit;

    -- Suppression du produit
    DELETE FROM PRODUIT WHERE id_produit = IdProduit;
END;
//
DELIMITER ;

-- Exécution de la procédure pour tester
CALL SupprimerProduit(1);

-- Affiche le contenu de la table PRODUIT pour vérifier la suppression
SELECT * FROM PRODUIT;
