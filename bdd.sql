use base_de_donnee_bioclipse;


-- Supprime les tables de la base de données pour pouvoir les recrées 
DROP TABLE IF EXISTS AVIS;
DROP TABLE IF EXISTS AJOUTER;
DROP TABLE IF EXISTS FAVORIS;
DROP TABLE IF EXISTS COMMANDE;
DROP TABLE IF EXISTS PRODUIT;
DROP TABLE IF EXISTS MESSAGE;
DROP TABLE IF EXISTS AFFILIER;
DROP TABLE IF EXISTS COMPTE;
DROP TABLE IF EXISTS GROUPE;
DROP TABLE IF EXISTS CATEGORIE;
DROP TABLE IF EXISTS ROLE;
DROP TABLE IF EXISTS AUTHENTIFICATION;

CREATE TABLE CATEGORIE(
   Id_categorie INT AUTO_INCREMENT,
   Nom_categorie VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_categorie)
);
   
CREATE TABLE GROUPE(
   Id_groupe INT AUTO_INCREMENT,
   Nom_groupe VARCHAR(50),
   Image_groupe VARCHAR(256),
   PRIMARY KEY(Id_groupe)
);

CREATE TABLE ROLE(
   Id_role INT AUTO_INCREMENT,
   Nom_role VARCHAR(50) NOT NULL,
   PRIMARY KEY(Id_role)
);

CREATE TABLE COMPTE(
   Id_compte INT AUTO_INCREMENT,
   Nom_compte VARCHAR(50) NOT NULL,
   Prenom_compte VARCHAR(50) NOT NULL,
   Adresse_email_compte VARCHAR(100) NOT NULL,
   Num_tel_compte VARCHAR(15) NOT NULL,
   Mot_de_passe_compte VARCHAR(256) NOT NULL,
   Adresse_postal_compte VARCHAR(50) NOT NULL,
   Ville_compte VARCHAR(50) NOT NULL,
   Code_postal_compte VARCHAR(10) NOT NULL,
   Image_compte VARCHAR(256),
   Nom_producteur VARCHAR(50),
   Num_siret_producteur VARCHAR(14),
   Id_role INT NOT NULL,
   Id_categorie INT,
   Statut_compte ENUM("Validé","En attente") DEFAULT "Validé",
   PRIMARY KEY(Id_compte),
   UNIQUE(Adresse_email_compte),
   UNIQUE(Num_tel_compte),
   FOREIGN KEY(Id_role) REFERENCES ROLE(Id_role),
   FOREIGN KEY(Id_categorie) REFERENCES CATEGORIE(Id_categorie)
);

CREATE TABLE MESSAGE(
   Id_message INT AUTO_INCREMENT,
   Date_message DATETIME NOT NULL,
   Contenu_message TEXT,
   Id_groupe INT NOT NULL,
   Id_compte INT NOT NULL,
   PRIMARY KEY(Id_message),
   FOREIGN KEY(Id_groupe) REFERENCES GROUPE(Id_groupe),
   FOREIGN KEY(Id_compte) REFERENCES COMPTE(Id_compte)
);

CREATE TABLE PRODUIT(
   Id_produit INT AUTO_INCREMENT,
   Nom_produit VARCHAR(100) NOT NULL,
   Desc_produit TEXT NOT NULL,
   Prix_produit DECIMAL(10,2) NOT NULL,
   Quantite_produit INT NOT NULL,
   Quantite_alerte_produit INT,
   Unite_produit VARCHAR(20) NOT NULL,
   Image_produit VARCHAR(256),
   Categorie_produit ENUM("viandes", "poisson", "produit laitier", "fruits et légumes", "céréale", "vin", "pain", "fromage", "pâtisserie") NOT NULL,
   Id_compte INT NOT NULL,
   PRIMARY KEY(Id_produit),
   FOREIGN KEY(Id_compte) REFERENCES COMPTE(Id_compte)
);

CREATE TABLE COMMANDE(
   Id_commande INT AUTO_INCREMENT,
   Date_commande DATE NOT NULL,
   Date_retrait_commande DATE NOT NULL,
   Id_compte INT NOT NULL,
   Statut_commande ENUM("en création","annuler", "en attente", "validé","recuperer"),
   PRIMARY KEY(Id_commande),
   FOREIGN KEY(Id_compte) REFERENCES COMPTE(Id_compte)
);

CREATE TABLE AVIS(
   Id_avis INT AUTO_INCREMENT,
   Note_avis DECIMAL(2,1),
   Commentaire_avis TEXT,
   Date_avis DATETIME NOT NULL,
   Id_produit INT NOT NULL,
   Id_compte INT NOT NULL,
   PRIMARY KEY(Id_avis),
   FOREIGN KEY(Id_produit) REFERENCES PRODUIT(Id_produit),
   FOREIGN KEY(Id_compte) REFERENCES COMPTE(Id_compte)
);

CREATE TABLE AJOUTER(
   Id_produit INT,
   Id_commande INT,
   Quantite_article INT NOT NULL,
   FOREIGN KEY(Id_produit) REFERENCES PRODUIT(Id_produit),
   FOREIGN KEY(Id_commande) REFERENCES COMMANDE(Id_commande)
);

CREATE TABLE AFFILIER(
   Id_compte INT,
   Id_groupe INT,
   FOREIGN KEY(Id_compte) REFERENCES COMPTE(Id_compte),
   FOREIGN KEY(Id_groupe) REFERENCES GROUPE(Id_groupe)
);


CREATE TABLE FAVORIS(
   Id_compte INT,
   Id_produit INT,
   FOREIGN KEY(Id_compte) REFERENCES COMPTE(Id_compte),
   FOREIGN KEY(Id_produit) REFERENCES PRODUIT(Id_produit)
);

CREATE TABLE AUTHENTIFICATION(
   Token VARCHAR(255),
   Id_compte INT,
   FOREIGN KEY(Id_compte) REFERENCES COMPTE(Id_compte)
);

/*--------------------------------------------------------------------
--                                                                  --
--                             Partie Catégorie                     --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/
INSERT INTO CATEGORIE (Nom_categorie) VALUES ('Maraîcher'),('Poissonnerie'),('Boucherie'),('Viticole'),('Céréalier'),('Fromager'),('Laitier'),('Pâtisserie'),('Boulangerie');

/*--------------------------------------------------------------------
--                                                                  --
--                             Partie Role                          --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/
INSERT INTO ROLE (Nom_role) VALUES ('Client'),('Producteur'),('Administrateur');
/*--------------------------------------------------------------------
--                                                                  --
--                             Partie Compte                        --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/

INSERT INTO COMPTE (Nom_compte, Prenom_compte, Adresse_email_compte, Num_tel_compte, Mot_de_passe_compte, Adresse_postal_compte, Ville_compte, Code_postal_compte, Image_compte, Nom_producteur,Num_siret_producteur,Id_role,Id_categorie)
VALUES 
('Buhot', 'Ewen', 'ewen.buhot@gmail.com', '0782029124', '14a4dc3a775a651d34689d9d22b5874c222316ff9125dada6baa24dae2495d03', '25 Quai André Pinçon', 'Laval', '53000', 'images/profil_pic/buhot.png',NULL,NULL,1,NULL),
('Martin', 'Sophie', 'sophie.martin@gmail.com', '0712345678', 'a20aff106fe011d5dd696e3b7105200ff74331eeb8e865bb80ebd82b12665a07', '35 avenue du Bois', 'Lyon', '69000', 'images/profil_pic/martin.png',NULL,NULL,1,NULL),
('Lefebvre', 'Claire', 'claire.lefebvre@gmail.com', '0698765432', 'afcda743284f8ad3186b7425eb4239714f01808747a34f8f613b3eb7f67d1159', '18 rue de la Paix', 'Marseille', '13000', 'images/profil_pic/lefebvre.png', NULL,NULL,1,NULL),
('Rousseau', 'Alex', 'alex.rousseau@gmail.com', '0787654321', '913f9f9e234e08ec6ee513208d9f0f87292407c459bf533d6a29a0ed8451442a', '4 place du Marché', 'Toulouse', '31000', 'images/profil_pic/rousseau.png',NULL,NULL,1,NULL),
('Blanchard', 'Éric', 'eric.blanchard@gmail.com', '0654321876', '7795ed80785cce4804caf1ea5cfde0f78efa4566aa27a8839a4fb79c4d48d45c', '23 rue des Rosiers', 'Nantes', '44000', 'images/profil_pic/blanchard.png',NULL,NULL,1,NULL),
('Moreau', 'Lucie', 'lucie.moreau@gmail.com', '0723456789', '30f8d85beecb883ddb0d922d5cee1f8c5e23263f5f7a790638a30621caf240aa', '34 Rue de la Paix', 'Laval', '53000', 'images/profil_pic/moreau.png',NULL,NULL,1,NULL),
('Leclerc', 'Alice', 'alice.leclerc@gmail.com', '0609876543', '13dc8554575637802eec3c0117f41591a990e1a2d37160018c48c9125063838a', '37 boulevard des Capucines', 'Lille', '59000', 'images/profil_pic/leclerc.png',NULL,NULL,1,NULL),
('Moulin', 'Stéphane', 'stephane.moulin@gmail.com', '0765432198', '1826d0c58a9676e3b0ccb8618b3373ff46595621a5361b74623a579bea8779e4', '11 Rue de Londres', 'Laval', '53000', 'images/profil_pic/moulin.png',NULL,NULL,1,NULL),
('Bertrand', 'Victor', 'victor.bertrand@gmail.com', '0687654329', 'd2cc3aac65c4fbae683493fa01b8a65d289b8c799a6badefb5ac3233a6a2dc15', '54 avenue des Ternes', 'Nice', '06000', 'images/profil_pic/bertrand.png',NULL,NULL,1,NULL),
('Lemaire', 'Julie', 'julie.lemaire@gmail.com', '0798765432', '688db25dc6cd670e86e17c178479e1a7e1095ac8945c22488fd3808cd888ac98', '2 Rue du Dr Roux', 'Laval', '53000', 'images/profil_pic/lemaire.png',NULL,NULL,1,NULL),
-- Insertion des 10 comptes producteurs
('Durand', 'Fabrice', 'fabrice.durand@gmail.com', '0634567890', '97544664e0e2f0615298f6efa4010f0d7b5e5a574f7639aa3913722091ff2791', '11 Rue Charles Landelle, 53000 Laval', 'Laval', '53000', 'images/profil_pic/boucherie_durand.png','Boucherie Durand','12345678901234',2,3),
('Michel', 'Sarah', 'sarah.michel@gmail.com', '0723456987', '60166ed1c9104dea906ca3bd8bd6a5da2acdfdc54411e7ac43e32f4f393e69f1', '14 Pl. de la Tremoille, 53000 Laval', 'Laval', '53000', 'images/profil_pic/domaine_sarah.png','Domaine SarahM','23456789012345',2,4),
('Lambert', 'Olivier', 'olivier.lambert@gmail.com', '0745678901', 'a96410ce88893ac0cbdd04741816aa76bf226a05a8a1e5ca0a0d96a88d02f946', 'Brétignolles, 53000 Laval', 'Laval', '53000', 'images/profil_pic/ferme_olivier.png','La ferme Olivier','34567890123456',2,5),
('Garnier', 'Valérie', 'valerie.garnier@gmail.com', '0687654921', '610ef95523ef49b88d747b18393c3a3c748fc44275a4976a5fb44e64ceb2e7d5', '4 Pl. d Avesnières, 53000 Laval', 'Laval', '53000', 'images/profil_pic/fromagerie.png','Fromagerie Gar','45678901234567',2,6),
('Fournier', 'Guillaume', 'guillaume.fournier@gmail.com', '0654321765', 'cbf7a96c90947e9d9e016d4d69306139d380c04a0cee96332be8a2738b432c34', '113 Rue du Pont de Mayenne, 53000 Laval', 'Laval', '53000', 'images/profil_pic/boulangerie2.png','La Boulangerie Guillaume','56789012345678',2,9),
('Leroy', 'Christine', 'christine.leroy@gmail.com', '0712345987', '50be3a826212f0f00ef3a0c22602bf2328e02523905e4106affd66881b2d0c6c', '92 Bd Frédéric Chaplet, 53000 Laval ', 'Laval', '53000', 'images/profil_pic/poissonerie.png','Poissonnerie Christine','67890123456789',2,2),
('Perrin', 'Philippe', 'philippe.perrin@gmail.com', '0798765412', '9d6d0db7b8f14808b5e6e7081143630ee720a6e36670ee3e7e195700ed60cb6c', '16 Rue Adolphe Beck, 53000 Laval', 'Laval', '53000', 'images/profil_pic/laiterie.png','Les produits laitier de Philippe','78901234567890',2,7),
('Catalon', 'Arkan', 'arkan.catalon@laposte.net', '0767683673', 'ffb516e3260944d41bee5eb2e1d0eecf25208817ff33243ea61917869e76679e', '10 Pl. de la Tremoille, 53000 Laval ', 'Laval', '53000', 'images/profil_pic/boulangerie.png','Boulangerie Arkan-ciel','69420345678901',2,8),
('Simon', 'Bernard', 'bernard.simon@gmail.com', '0676543289', '40835dad29fc6513e78682d1ea744ed76e33e6bbbd93c7d794d9abbc1b4c151b', '3 Rue Solférino, 53000 Laval', 'Laval', '53000', 'images/profil_pic/patisserie.png','BerSi pâtisserie','90123456789012',2,1),
('Henry', 'Françoise', 'francoise.henry@gmail.com', '0654321987', '5d5183327a7a1989df7520b81877995658488730506a88e91950480170faf09d', 'Le Riblay, 53260 Entrammes', 'Entrammes', '53260', 'images/profil_pic/maraicher.png','Les Fruits et légumes de Françoise','01234567890123',2,9),
-- Insertion des 3 comptes administrateurs 
('Administrateur', 'Kaaris', 'or.noir@gmail.com', '0601244567', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', '13 rue des Fleurs', 'Paris', '75000', 'images/profil_pic/profil.png',NULL,NULL,3,NULL),
('Administrateur', 'Peter', 'peter.parker@gmail.com', '0609836543', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', '5 avenue du Bois', 'Lyon', '69000', 'images/profil_pic/profil.png',NULL,NULL,3,NULL),
('Administrateur', 'Clara', 'clara.chevalier@gmail.com', '0612325678', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', '12 rue de la Paix', 'Marseille', '13000', 'images/profil_pic/profil.png',NULL,NULL,3,NULL);

/*--------------------------------------------------------------------
--                                                                  --
--                             Partie Produit                       --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/


-- Insertion des produits pour Pâtisserie
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Éclair au chocolat', "L'éclair au chocolat vient d'une boulangerie proche, célèbre pour sa pâtisserie délicate. Cet éclair contient des allergènes communs tels que le gluten (dans la pâte), les œufs, et les produits laitiers (dans la crème et le glaçage). Un régal pour les amateurs de chocolat, à déguster avec précaution pour les personnes allergiques. ", 3.0, 50, 100, 'Pièce', 'images/produit/eclair_chocolat.jpg', 'pâtisserie', 18),
('Tartelette aux fraises', 'La tartelette aux fraises, préparée avec des ingrédients locaux, est une pâtisserie fraîche et délicieuse. Les allergènes courants dans cette tartelette incluent le gluten (présent dans la pâte), les produits laitiers (si de la crème est utilisée), et potentiellement des œufs (dans la pâte ou la garniture). ', 3.5, 40, 0, 'Pièce', 'images/produit/tartelette_fraises.jpg', 'pâtisserie', 18),
('Mille-feuille', 'Le mille-feuille, confectionné avec des ingrédients locaux, est une superposition raffinée de pâte feuilletée croustillante et de crème pâtissière onctueuse. Les allergènes principaux incluent le gluten (dans la pâte feuilletée), les œufs et les produits laitiers (dans la crème).', 4.5, 30, 0, 'Pièce', 'images/produit/mille_feuille.jpg', 'pâtisserie', 18),
('Macaron', 'Les macarons, disponibles en divers parfums et à différents prix, sont fabriqués localement avec des ingrédients de qualité. Ces délicieuses petites gourmandises contiennent comme allergènes principaux les amandes (ou autres fruits à coque, selon les arômes), les œufs (dans les coques de macaron), et parfois des produits laitiers (dans certaines garnitures).', 2.0, 100, 0, 'Pièce', 'images/produit/macaron.jpg', 'pâtisserie', 18),
('Cupcake', 'Les cupcakes, préparés localement, offrent une variété de saveurs et de décorations. Les allergènes courants dans ces petits gâteaux incluent le gluten (dans le gâteau), les œufs et les produits laitiers (dans le gâteau et le glaçage). Ces douceurs sont appréciées pour leur aspect coloré et leur saveur riche, parfaits pour une gourmandise ou une occasion spéciale.', 3.5, 60, 0, 'Pièce', 'images/produit/cupcake.jpg', 'pâtisserie', 18),
('Brownie', 'Les brownies, confectionnés localement, sont réputés pour leur texture riche et fondante. Les allergènes typiques dans ces délices au chocolat incluent le gluten (dans la farine), les œufs, et les produits laitiers (dans le beurre et le chocolat). Ces gâteaux au chocolat dense sont un favori pour les amateurs de desserts intenses et chocolatés.', 3.0, 70, 0, 'Pièce', 'images/produit/brownie.jpg', 'pâtisserie', 18),
('Cheesecake', 'Le cheesecake, préparé localement, se distingue par sa base croustillante et sa garniture crémeuse. Les allergènes courants dans ce dessert incluent le gluten (dans la base de biscuit), les œufs, et les produits laitiers (dans la garniture au fromage). C est un choix populaire pour son goût riche et sa texture onctueuse.', 6.0, 20, 0, 'Pièce', 'images/produit/cheesecake.jpg', 'pâtisserie', 18),
('Gâteau au chocolat', 'Le gâteau au chocolat, fait avec des ingrédients locaux, est célèbre pour sa texture moelleuse et son goût riche en cacao. Les allergènes principaux dans ce gâteau incluent le gluten (dans la farine), les œufs, et les produits laitiers (dans le beurre et le chocolat). Ce dessert est un classique indémodable, apprécié par les amateurs de chocolat. ', 20.0, 10, 0, 'Pièce', 'images/produit/gateau_chocolat.jpg', 'pâtisserie', 18);

-- Insertion des produits pour Boucherie
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Steak', 'Le steak de bœuf local est issu de bétail élevé dans la région, garantissant fraîcheur et qualité. Élevé selon des méthodes traditionnelles, ce bœuf offre une saveur riche et authentique, valorisant les pratiques d agriculture locale. Ce choix de viande favorise le soutien aux producteurs de la communauté et assure une expérience culinaire exceptionnelle.', 11.55, 100, 0, 'Kg', 'images/produit/steak.jpg', 'viandes', 11),
('Poulet Entier', 'Le poulet entier, provenant de fermes locales, est élevé dans des conditions optimales, assurant une qualité et une fraîcheur exceptionnelles. Ces poulets sont nourris avec des aliments naturels et élevés dans un environnement respectueux, ce qui se reflète dans la saveur délicate et la texture tendre de la viande. Choisir un poulet entier local soutient l agriculture de proximité et garantit un produit sain et savoureux.', 7.0, 50, 0, 'Pièce', 'images/produit/poulet_entier.jpg', 'viandes', 11),
('Saucisse', 'Les saucisses locales sont fabriquées à partir de viandes soigneusement sélectionnées provenant d élevages de la région. Elles se distinguent par leur fraîcheur et la qualité de leurs ingrédients, souvent assaisonnées selon des recettes traditionnelles locales. En choisissant ces saucisses, vous soutenez non seulement les producteurs locaux mais vous bénéficiez également de saveurs authentiques et d une traçabilité claire de la viande.', 20.5, 200, 0, 'Kg', 'images/produit/saucisse.jpg', 'viandes', 11),
('Côtes d agneau', 'Les côtes d agneau locales proviennent d agneaux élevés dans des fermes régionales, où ils sont nourris et soignés en respectant des méthodes d élevage traditionnelles et durables. Cette proximité garantit une viande fraîche et de haute qualité, avec des saveurs riches et authentiques reflétant le terroir local. En optant pour ces côtes d agneau, vous soutenez l agriculture de la région et profitez d un produit exceptionnel, tant en goût qu en fraîcheur.', 18.9, 80, 0, 'Kg', 'images/produit/cotes_agneau.jpg', 'viandes', 11),
('Rôti de Boeuf', 'Le roti de bœuf local provient de bétail élevé dans les fermes avoisinantes, garantissant une viande de premier choix, fraîche et savoureuse. Ces animaux sont nourris avec des aliments de qualité et élevés dans un environnement respectueux, ce qui se traduit par une tendreté et une saveur exceptionnelles du filet.', 57.0, 40, 0, 'Kg', 'images/produit/roti_boeuf.jpg', 'viandes', 11),
('Filet de poulet', 'Le filet de poulet local est issu de volailles élevées dans des fermes de proximité, où elles sont nourries avec des aliments naturels et élevées dans des conditions respectueuses de leur bien-être. Cette approche garantit une viande de poulet de haute qualité, tendre et savoureuse. ', 12.0, 90, 0, 'Kg', 'images/produit/filet_poulet.jpg', 'viandes', 11),
('Jambon', 'Le jambon cuit local est préparé à partir de porcs élevés dans des fermes régionales, assurant ainsi une traçabilité et une qualité irréprochables. Ces porcs sont nourris avec des aliments de qualité et élevés dans des conditions qui respectent leur bien-être, ce qui contribue à la saveur riche et authentique du jambon. En choisissant ce jambon cuit local, ', 10.5, 100, 0, 'Kg', 'images/produit/jambon.jpg', 'viandes', 11),
('Canard Entier', 'Le canard entier local provient de fermes de la région où les canards sont élevés en plein air et nourris avec une alimentation naturelle. Cette approche respectueuse assure une viande de canard de qualité supérieure, à la fois tendre et riche en saveur. ', 14.0, 20, 0, 'Pièce', 'images/produit/canard_entier.jpg', 'viandes', 11),
('Foie Gras', 'Le foie gras local est un produit gastronomique de haute qualité, issu de canards ou d oies élevés dans des fermes régionales. Ces volailles sont nourries et soignées selon des méthodes traditionnelles et éthiques, assurant un foie gras riche en goût et de texture onctueuse.', 50.0, 30, 0, 'Kg', 'images/produit/foie_gras.jpg', 'viandes', 11),
('Pâté de canard', 'Le pâté de campagne local est un mets rustique et traditionnel, préparé à partir de viandes et d ingrédients soigneusement sélectionnés provenant des fermes environnantes. Ces ingrédients de qualité sont combinés selon des recettes ancestrales, donnant au pâté son goût authentique et sa texture caractéristique.', 5.0, 150, 0, 'Kg', 'images/produit/pate.jpg', 'viandes', 11);


-- Insertion des produits pour Viticole
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Vin Rouge', 'Bordeaux 2020 Vin rouge bio local est une fierté de la région, réputé pour être le meilleur de son terroir. Produit à partir de raisins cultivés selon des pratiques biologiques, sans pesticides ni engrais chimiques, ce vin reflète l engagement des vignerons locaux envers la qualité et le respect de l environnement.', 12.0, 100, 0, 'Pièce', 'images/produit/vin_rouge.jpg', 'vin', 12),
('Vin Blanc', 'Chardonnay 2021 Vin blanc bio local est considéré comme le meilleur de la région, issu de vignobles pratiquant une agriculture biologique. Les raisins sont cultivés sans l usage de produits chimiques, dans le respect total de l environnement, ce qui permet de capturer l essence pure du terroir local. Cette attention portée à la qualité et à la durabilité se reflète dans les saveurs distinctives et la finesse du vin. ', 11.0, 90, 0, 'Pièce', 'images/produit/vin_blanc.jpg', 'vin', 12),
('Champagne', 'Champagne bio et local de cette région se distingue comme étant le meilleur, symbolisant l excellence en matière de viticulture durable. Cultivé dans des vignobles où l on privilégie des méthodes biologiques, sans pesticides ni engrais chimiques, chaque bouteille capture l essence du terroir local. ', 500.0, 50, 0, 'Pièce', 'images/produit/champagne.jpg', 'vin', 12),
('Rosé', 'Côtes de Provence 2021 Rosé bio et local de cette région est acclamé comme le meilleur, incarnant l harmonie parfaite entre pratiques viticoles durables et excellence en vinification. Issu de raisins cultivés biologiquement, sans recours aux produits chimiques nocifs, ce vin reflète une véritable connexion avec la nature et le terroir local.', 6.5, 80, 0, 'Pièce', 'images/produit/rose.jpg', 'vin', 12);


-- Insertion des produits pour le Céréalier
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Blé Tendre', 'Le blé tendre bio est cultivé sans l utilisation de pesticides ou d engrais chimiques, respectant ainsi les principes de l agriculture biologique. Cette méthode favorise un produit plus sain et écologique, garantissant un blé de haute qualité tout en préservant l environnement.', 2.0, 200, 20, 'Kg', 'images/produit/ble_tendre.jpg', 'céréale', 13),
('Orge Perlé', 'L orge perlé bio de l agriculteur est un grain entier soigneusement décortiqué et poli pour enlever l enveloppe extérieure. Ce processus préserve les nutriments essentiels tout en offrant une texture plus douce et un temps de cuisson réduit. Cultivé selon des méthodes biologiques.', 7.3, 150, 15, 'Kg', 'images/produit/orge_perle.jpg', 'céréale', 13),
('Farine de Seigle', 'La farine de seigle bio provient de grains de seigle cultivés sans utilisation de pesticides ou d engrais artificiels. Elle est moulue de manière traditionnelle pour conserver toutes ses qualités nutritives, notamment sa richesse en fibres. Cette farine apporte une saveur distincte et une texture dense', 4.9, 100, 10, 'Kg', 'images/produit/farine_seigle.jpg', 'céréale', 13);



-- Insertion des produits pour Fromager
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Camembert', 'Le Camembert local est un fromage onctueux à pâte molle, célèbre pour sa croûte blanche duveteuse. Il offre un goût complexe qui évolue de doux à terreux, parfait pour être savouré avec une baguette croustillante ou des fruits frais.', 4.0, 100, 0, 'Pièce', 'images/produit/camembert.jpg', 'produit laitier', 14),
('Roquefort', 'Roquefort AOP Savourez l intensité unique du Roquefort bio, un fromage bleu d exception, affiné avec passion dans les caves traditionnelles. Ce joyau de la gastronomie française, à la texture fondante et aux veines bleu-vert caractéristiques, offre un goût riche et prononcé, avec des notes piquantes et une pointe de douceur.', 6.0, 70, 0, 'kg', 'images/produit/roquefort.jpg', 'produit laitier', 14),
('Comté', ' Ce fromage à pâte pressée cuite, d origine locale, se distingue par sa texture ferme et son goût riche de noix et de caramel. Vieilli dans des caves locales, le Comté développe des cristaux de protéine qui ajoutent à sa complexité gustative.', 7.5, 80, 0, 'kg', 'images/produit/comte.jpg', 'produit laitier', 14),
('Brie', ' Le Brie, un classique des fromages à pâte molle, est connu pour sa croûte comestible et sa pâte riche et veloutée. Fabriqué localement, il possède un profil de saveur qui varie de doux et beurré à terreux, selon son degré de maturité.', 5.0, 60, 0, 'kg', 'images/produit/brie.jpg', 'produit laitier', 14),
('Chèvre', 'Ce fromage de chèvre local, frais et léger, se caractérise par sa texture crémeuse et son goût légèrement acidulé. Il est souvent agrémenté d herbes ou d épices, ajoutant une dimension supplémentaire à sa saveur délicate.', 5.5, 50, 0, 'Pièce', 'images/produit/chevre.jpg', 'produit laitier', 14),
('Gruyère', 'Le Gruyère est un fromage à pâte dure, connu pour ses petits trous et son goût de fruité à noisette. Il est idéal fondu dans les soupes, les quiches et les gratins, où il apporte une richesse et une profondeur de saveur inégalées.', 8.0, 40, 0, 'kg', 'images/produit/gruyere.jpg', 'produit laitier', 14);



-- Insertion des produits pour Boulangerie
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Baguette', 'Cette baguette est l exemple parfait de la boulangerie traditionnelle française. Avec une croûte croustillante et dorée et une mie aérée et légère, elle est fabriquée avec de la farine de qualité supérieure provenant de la région.', 1.0, 200, 0, 'Pièce', 'images/produit/baguette.jpg', 'pain', 15),
('Croissant', ' Les croissants de cette boulangerie sont réputés pour leur feuilletage parfait et leur saveur beurrée distinctive. Ils sont façonnés à la main et cuits jusqu à obtenir une couleur dorée, symbolisant le savoir-faire artisanal local.', 1.5, 100, 0, 'Pièce', 'images/produit/croissant.jpg', 'pâtisserie', 15),
('Pain Complet', ' Riche en fibres, ce pain complet est fait à partir de grains entiers moulus localement. Il a une texture satisfaisante et un goût profond qui le rend parfait pour les sandwiches ou le petit-déjeuner.', 3.0, 50, 0, 'Pièce', 'images/produit/pain_complet.jpg', 'pain', 15),
('Brioche', 'La brioche de cette boulangerie est célèbre pour sa texture soyeuse et son goût légèrement sucré. Enrichie en beurre de la meilleure qualité, elle offre une mie filante et délicate.', 4.0, 40, 0, 'Pièce', 'images/produit/brioche.jpg', 'pâtisserie', 15),
('Pain aux Noix', 'Ce pain est parsemé généreusement de noix fraîches de la région, lui donnant une texture croquante et un goût riche. Il est idéal pour accompagner du fromage ou comme base pour des tartines gourmandes.', 4.5, 25, 0, 'Pièce', 'images/produit/pain_noix.jpg', 'pain', 15),
('Pain au chocolat', 'Ces pains au chocolat sont une gourmandise irrésistible, combinant une pâte feuilletée aérienne avec des barres de chocolat fondant. Leur texture croustillante et leur cœur chocolaté en font une spécialité prisée dans la région.', 1.8, 80, 0, 'Pièce', 'images/produit/chocolatine.jpg', 'pain', 15);



-- Insertion des produits pour Poissonnerie
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Saumon', 'Le saumon local provient des eaux pures de la région, offrant une chair rose tendre et délicate. Élevé de manière responsable, il est riche en acides gras oméga-3, ce qui le rend sain et savoureux. Idéal pour des grillades légères ou des plats au four.', 20.0, 50, 0, 'Kg', 'images/produit/saumon.jpg', 'poisson', 16),
('Crevettes', 'Ces crevettes locales sont pêchées avec soin dans les eaux voisines. Leur texture ferme et leur goût sucré en font un met de choix pour les grillades, les sautés ou les plats de fruits de mer.', 25.0, 30, 0, 'Kg', 'images/produit/crevettes.jpg', 'poisson', 16),
('Huîtres', 'Les huîtres locales sont cultivées dans les estuaires de la région, ce qui leur confère une saveur saline unique. Leur fraîcheur et leur délicatesse en font une option idéale pour les plateaux de fruits de mer ou à déguster simplement avec un filet de citron.', 12.0, 100, 0, 'Pièce', 'images/produit/huitres.jpg', 'poisson', 16),
('Thon rouge', 'Le thon rouge local est une star des mers. Pêché dans les eaux environnantes, il est apprécié pour sa chair tendre et son goût robuste. Parfait pour les sashimis ou les grillades.', 18.0, 40, 0, 'Kg', 'images/produit/thon_rouge.jpg', 'poisson', 16),
('Sardines', 'Ces sardines locales sont réputées pour leur saveur méditerranéenne. Grillées, marinées ou en conserve, elles sont une délicieuse source de protéines riches en oméga-3.', 6.0, 70, 0, 'Kg', 'images/produit/sardines.jpg', 'poisson', 16),
('Moules', 'Les moules locales sont charnues et parfumées, élevées dans des eaux propres. Elles sont idéales pour les plats de pâtes, les bouillabaisses ou les moules marinières.', 5.0, 100, 0, 'Kg', 'images/produit/moules.jpg', 'poisson', 16),
('Coquilles Saint-Jacques', 'Les coquilles Saint-Jacques locales sont une délicatesse de la mer. Leur chair nacrée est idéale pour les préparations raffinées telles que les gratins ou les poêlées.', 30.0, 20, 0, 'Kg', 'images/produit/coquilles_st_jacques.jpg', 'poisson', 16),
('Lotte', 'Les queues de lotte locales sont tendres et succulentes. Leur chair blanche est parfaite pour les ragoûts, les currys ou les plats mijotés.', 22.0, 25, 0, 'Kg', 'images/produit/lotte.jpg', 'poisson', 16);


-- Insertion des produits pour Laitier
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Lait entier', 'Redécouvrez la pureté et la richesse du lait entier bio, issu d une production responsable et respectueuse des animaux. Ce lait, onctueux et riche en saveurs naturelles, est idéal pour vos céréales, vos boissons chaudes ou comme ingrédient de base dans vos recettes de pâtisserie. Son goût crémeux et sa fraîcheur rappellent les matins paisibles à la ferme, où la qualité prime sur la quantité.', 1.5, 200, 0, 'l', 'images/produit/lait_entier.jpg', 'produit laitier', 17),
('Yaourt nature', 'Ce yaourt nature bio est un produit authentique et sain. Fabriqué avec du lait issu de fermes locales, il garantit une fraîcheur inégalée et une traçabilité complète. Sa texture onctueuse et son goût légèrement acidulé en font un délice pour tous ceux qui recherchent des produits naturels et simples. Sans additifs ni conservateurs, ce yaourt reflète un engagement envers une alimentation biologique et respectueuse de l environnement.', 0.5, 150, 0, 'Pièce', 'images/produit/yaourt_nature.jpg', 'produit laitier', 17),
('Fromage blanc', 'Le fromage blanc bio local est une spécialité crémeuse et douce. Fabriqué à partir de lait biologique de haute qualité, ce fromage blanc est à la fois riche en goût et léger en texture. Idéal pour les petits déjeuners ou comme base pour des recettes sucrées ou salées, il se distingue par son caractère frais et sa douceur naturelle. ', 2.0, 100, 0, 'Pièce', 'images/produit/fromage_blanc.jpg', 'produit laitier', 17),
('Beurre doux', 'Ce beurre doux local est un incontournable de la gastronomie. Fabriqué avec soin à partir de crème fraîche de lait de vaches élevées localement, il offre une texture fondante et un goût délicat. Parfait pour la cuisson, la pâtisserie ou simplement étalé sur du pain, ce beurre est un témoignage de la richesse des produits locaux. ', 2.5, 80, 0, 'Pièce', 'images/produit/beurre_doux.jpg', 'produit laitier', 17),
('Crème fraîche', 'Notre crème fraîche bio est un produit d exception. Élaborée avec soin à partir de lait biologique, elle se distingue par sa consistance riche et onctueuse. Que ce soit pour enrichir des sauces, des soupes ou des desserts, cette crème fraîche apporte une touche de douceur et de finesse à toute préparation.', 1.8, 70, 0, 'Pièce', 'images/produit/creme_fraiche.jpg', 'produit laitier', 17),
('Lait d amande', 'Le lait d amande est une alternative végétale délicieuse et nutritive au lait traditionnel. Fabriqué à partir d amandes finement broyées et mélangées à de l eau, ce lait offre une texture légère et un goût subtilement sucré et noisetté. Riche en vitamines et en minéraux, il est idéal pour les personnes intolérantes au lactose ou suivant un régime végétalien.', 2.5, 50, 0, 'l', 'images/produit/lait_amande.jpg', 'produit laitier', 17),
('Emmental', 'L emmental en tranches bio est un fromage classique réinventé. Fabriqué à partir de lait biologique, cet emmental se distingue par son goût riche et sa texture moelleuse. Les tranches sont pratiques pour les sandwiches, les gratins ou comme en-cas. ', 4.0, 40, 0, 'Pièce', 'images/produit/emmental.jpg', 'produit laitier', 17),
('Ricotta', 'Plongez dans la douceur de notre ricotta bio, un fromage frais et léger, fabriqué avec le plus grand soin. Sa texture fine et son goût délicatement crémeux en font un ingrédient de choix pour vos lasagnes, cheesecakes, ou comme touche finale dans vos plats de pâtes. Cette ricotta, empreinte de la simplicité et de l authenticité des produits artisanaux, réveillera vos plats avec sa fraîcheur et son élégance', 3.0, 60, 0, 'Pièce', 'images/produit/ricotta.jpg', 'produit laitier', 17);




-- Insertion des produits pour Maraicher
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Carotte', 'Nos carottes bio sont un festival de saveurs et de fraîcheur. Élevées sans produits chimiques, elles brillent par leur couleur vive et leur croquant naturel. Riches en vitamines et en fibres, elles sont idéales pour les salades, les jus ou simplement croquées telles quelles. Leur douceur naturelle séduit aussi bien les petits que les grands.', 1.2, 100, 0, 'Kg', 'images/produit/carotte.jpg', 'fruits et légumes', 20),
('Pomme de terre', 'Cultivées localement et sans pesticides, nos pommes de terre bio sont un trésor de la nature. Avec leur peau fine et leur chair tendre, elles sont parfaites pour une variété de recettes, de la purée onctueuse aux frites croustillantes. Leur goût riche et terreux reflète la qualité du sol dans lequel elles ont été soigneusement cultivées.', 1.0, 200, 0, 'Kg', 'images/produit/pomme_de_terre.jpg', 'fruits et légumes', 20),
('Tomate', 'Découvrez le goût authentique de nos tomates bio, cultivées avec passion et respect de l environnement. Ces joyaux rouges, juteux et pleins de saveur, sont un incontournable pour vos salades, sauces ou tartes. Leur fraîcheur inégalée éveille les papilles et rappelle les saveurs d antan.', 3.0, 50, 0, 'Kg', 'images/produit/tomate.jpg', 'fruits et légumes', 20),
('Courgette', 'Explorez la fraîcheur naturelle de nos courgettes vertes bio, cultivées avec soin et une conscience écologique profonde. Ces trésors verts, croquants et débordants de saveurs subtiles, sont parfaits pour enrichir vos plats de légumes, vos gratins ou vos soupes. Leur texture tendre et leur goût délicat éveillent les sens, offrant une expérience gustative qui fait écho aux traditions culinaires authentiques.', 1.5, 75, 0, 'Kg', 'images/produit/courgette.jpg', 'fruits et légumes', 20),
('Aubergine', 'Nos aubergines, cultivées localement, sont un hymne à la douceur méditerranéenne. Avec leur peau lisse et leur chair spongieuse, elles sont parfaites pour des recettes comme la ratatouille, la moussaka ou grillées au barbecue. Leurs nuances de violet profond ajoutent une touche d élégance à chaque plat. ', 2.0, 40, 0, 'Kg', 'images/produit/aubergine.jpg', 'fruits et légumes', 20),
('Pomme', 'Les pommes Golden de notre verger local sont une véritable explosion de douceur. Leur peau finement dorée renferme une chair croquante et juteuse, idéale pour les collations, les tartes ou les compotes. Leur saveur délicatement sucrée ravira tous les amateurs de fruits frais.', 2.5, 150, 0, 'Kg', 'images/produit/pomme.jpg', 'fruits et légumes', 20),
('Orange', 'Nos oranges, gorgées de soleil et de vitamine C, sont un pur délice. Leur peau brillante cache une pulpe juteuse et acidulée, parfaite pour un jus rafraîchissant ou pour ajouter une touche d agrume à vos plats. Leur fraîcheur est la garantie d une qualité supérieure.', 2.0, 80, 0, 'Kg', 'images/produit/orange.jpg', 'fruits et légumes', 20),
('Fraise', 'Succombez à la tentation de nos fraises de saison, cueillies à leur apogée de maturité. Leur rouge éclatant et leur parfum envoûtant sont le symbole de leur fraîcheur. Naturellement sucrées et fondantes, elles sont idéales pour les desserts, les salades de fruits ou simplement dégustées nature.', 4.0, 40, 0, 'Kg', 'images/produit/fraise.jpg', 'fruits et légumes', 20),
('Raisin', 'Le raisin blanc de notre vignoble local est un petit bijou de douceur et d élégance. Ses grains juteux et sucrés sont parfaits pour une pause fraîcheur ou pour accompagner un plateau de fromages. Leur culture bio garantit une dégustation saine et respectueuse de l environnement.', 3.5, 50, 0, 'Kg', 'images/produit/raisin.jpg', 'fruits et légumes', 20);


-- Insertion des produits pour la boulangerie
INSERT INTO PRODUIT (Nom_produit, Desc_produit, Prix_produit, Quantite_produit, Quantite_alerte_produit, Unite_produit, Image_produit,Categorie_produit, Id_compte) VALUES
('Baguette', 'Notre baguette traditionnelle est un classique indémodable. Fabriquée avec de la farine bio locale, elle se distingue par sa croûte croustillante et sa mie aérée et moelleuse. Parfaite pour accompagner vos repas ou pour savourer avec du beurre, cette baguette est le symbole du savoir-faire boulanger français.', 1.2, 100, 10, 'Unité', 'images/produit/baguette.jpg', 'pain', 19),
('Croissant', 'Ces croissants, préparés avec amour et savoir-faire, sont le plaisir ultime pour débuter la journée. Leur pâte feuilletée bio, légère et croustillante, cache un cœur tendre et beurré. Ils sont parfaits pour un petit-déjeuner gourmand ou une pause-café raffinée.', 1.5, 50, 5, 'Unité', 'images/produit/croissant.jpg', 'pâtisserie', 19),
('Pain Complet', 'Notre pain complet est un concentré de bienfaits. Fabriqué à partir de farine complète bio, il est riche en fibres et en nutriments essentiels. Sa mie dense et savoureuse en fait un excellent choix pour un petit-déjeuner nourrissant ou pour accompagner vos repas.', 2.5, 30, 5, 'Unité', 'images/produit/pain_complet.jpg', 'pain', 19),
('Madeleine', 'Nos madeleines, moelleuses et légèrement dorées, sont une douceur irrésistible. Préparées avec des ingrédients bio de qualité, elles offrent une texture aérienne et un goût subtilement vanillé. Elles sont parfaites pour un goûter gourmand ou pour accompagner un thé.', 0.5, 100, 10, 'Unité', 'images/produit/madeleine.jpg', 'pâtisserie', 19),
('Pain aux Noix', 'Ce pain aux noix est un délice rustique et gourmand. Agrémenté de noix croquantes et de farine complète bio, il offre un goût riche et une texture satisfaisante. Idéal pour les fromages ou pour un sandwich savoureux, ce pain est un incontournable pour les amateurs de saveurs authentiques.', 3.0, 25, 3, 'Unité', 'images/produit/pain_noix.jpg', 'pain', 19),
('Chausson aux Pommes', 'Nos chaussons aux pommes sont une véritable célébration de la simplicité et du goût. La pâte feuilletée bio enveloppe une garniture généreuse de pommes sucrées et légèrement acidulées. Ces chaussons sont parfaits pour une pause sucrée à tout moment de la journée.', 2.0, 30, 3, 'Unité', 'images/produit/chausson_aux_pommes.jpg', 'pâtisserie', 19),
('Brioche', 'Brioche de cette boulangerie est célèbre pour sa texture soyeuse et son goût légèrement sucré. Enrichie en beurre de la meilleure qualité, elle offre une mie filante et délicate.', 4.0, 15, 2, 'Unité', 'images/produit/brioche.jpg', 'pâtisserie', 19);

/*--------------------------------------------------------------------
--                                                                  --
--                             Partie Commande                      --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/

-- Insertion de commandes
INSERT INTO COMMANDE (Date_commande, Date_retrait_commande, Statut_commande,Id_compte) VALUES
('2024-01-22', '2024-01-22', 'en création',1),
('2024-01-18', '2024-01-18', 'en création',2),
('2024-05-11', '2024-05-11', 'en création',3),
('2024-01-16', '2024-01-16', 'en création',4),
('2024-02-15', '2024-02-15', 'en création',5),
('2024-11-16', '2024-11-16', 'en création',6),
('2024-05-05', '2024-05-05', 'en création',7),
('2024-02-09', '2024-02-09', 'en création',8),
('2024-06-27', '2024-06-27', 'en création',9),
('2024-06-09', '2024-06-09', 'en création',10),
('2023-10-21', '2023-10-22', 'Recuperer',1),
('2023-10-21', '2023-10-22', 'Annuler',1),
('2023-10-21', '2023-10-22', 'validé',1),
('2023-10-21', '2023-10-22', 'En attente',1),
('2023-10-21', '2023-10-22', 'En attente',1),
('2023-10-21', '2023-10-22', 'En attente',1),
('2023-10-21', '2023-10-22', 'En attente',1),
('2023-10-21', '2023-10-22', 'En attente',1),
('2023-10-21', '2023-10-22', 'En attente',1),
('2023-10-21', '2023-10-22', 'En attente',1),
('2023-10-21', '2023-10-22', 'En attente',1);


/*--------------------------------------------------------------------
--                                                                  --
--                        Partie AJOUTER                            --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/
-- Panier 1
INSERT INTO AJOUTER (Id_produit, Id_commande, Quantite_article) VALUES
(1, 1, 3),
(2, 1, 4),
(3, 1, 2),

-- Panier 2
(4, 2, 1),
(5, 2, 3),
(6, 2, 2),
(7, 2, 4),

-- Panier 3
(3, 3, 3),
(4, 3, 2),
(8, 3, 1),

-- Panier 4
(2, 4, 2),
(5, 4, 1),
(6, 4, 4),
(8, 4, 3),

-- Panier 5
(1, 5, 3),
(4, 5, 2),
(7, 5, 1),

-- Panier 6
(3, 6, 2),
(6, 6, 3),
(7, 6, 1),
(8, 6, 4),

-- Panier 7
(2, 7, 2),
(5, 7, 4),
(6, 7, 1),

-- Panier 8
(1, 8, 3),
(3, 8, 1),
(4, 8, 2),
(8, 8, 1),

-- Panier 9
(1, 9, 4),
(2, 9, 3),
(7, 9, 1),

-- Panier 10
(5, 10, 2),
(6, 10, 3),
(8, 10, 1),
(4, 10, 4),

-- Panier 11
(1, 11, 2),
(3, 11, 3),
(6, 11, 4),

-- Panier 12
(2, 12, 3),
(4, 12, 2),
(7, 12, 1),
(8, 12, 2),

-- Panier 13
(1, 13, 3),
(5, 13, 2),
(6, 13, 1),

-- Panier 14
(3, 14, 4),
(4, 14, 3),
(7, 14, 1),
(8, 14, 2),

-- Panier 15
(2, 15, 1),
(5, 15, 3),
(6, 15, 4),

-- Panier 16
(1, 16, 4),
(3, 16, 1),
(4, 16, 2),
(7, 16, 3),

-- Panier 17
(2, 17, 2),
(5, 17, 3),
(8, 17, 1),

-- Panier 18
(4, 18, 2),
(6, 18, 1),
(7, 18, 3),
(8, 18, 4),

-- Panier 19
(1, 19, 3),
(2, 19, 1),
(5, 19, 4),

-- Panier 20
(3, 20, 2),
(6, 20, 1),
(7, 20, 4),
(8, 20, 3),

-- Panier 21
(1, 21, 2),
(4, 21, 3),
(5, 21, 1);









/*--------------------------------------------------------------------
--                                                                  --
--                             Partie Avis                          --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/

-- Insertion des 40 avis !!!! mettre des tiret - exemple : 20230101 -> 2023-01-01
INSERT INTO AVIS (Note_avis, Commentaire_avis, Date_avis, Id_produit, Id_compte) VALUES
(4.5, "Après avoir goûté cet éclair au chocolat, je lui donne sans hésiter une note de 4,5. 
   La combinaison du chocolat riche et onctueux avec la pâte légère et moelleuse était presque parfaite. 
   Chaque bouchée offrait une explosion de saveurs, bien équilibrée entre la douceur et l'intensité du chocolat. 
   Bien qu il y ait toujours de la place pour de petites améliorations, cet éclair est sans doute l'un des meilleurs 
   que j'ai pu déguster. Un vrai plaisir pour les papilles !", '2023-01-01 12:00:00',1, 1),
(3.0, "Cette tartelette aux fraises mérite une note honnête de 3. Les fraises étaient fraîches et juteuses, 
   ce qui ajoutait une belle touche de fraîcheur. Cependant, la pâte était un peu trop épaisse et manquait de croustillant. 
   La crème pâtissière, bien que savoureuse, aurait pu être plus légère pour mieux compléter la texture des fraises. 
   Dans l'ensemble, c'était une tartelette agréable, mais il y avait certainement des aspects qui auraient pu être améliorés 
   pour une expérience gustative plus satisfaisante.", '2023-01-02 14:20:00',2, 1),
(5.0, "Ce mille-feuille mérite sans aucun doute une note parfaite de 5/5. Chaque couche de pâte feuilletée était parfaitement 
   croustillante et légère, créant une texture divine en bouche. La crème pâtissière entre les couches était onctueuse, 
   riche en saveur, mais pas trop sucrée, ce qui équilibrait parfaitement le plat. Les finitions étaient également impeccables, 
   ajoutant une touche d'élégance. Dans son ensemble, ce mille-feuille était une œuvre d'art culinaire, alliant parfaitement 
   texture et goût pour une expérience gustative inoubliable. Absolument délicieux !", '2023-01-03 09:30:00',3, 1),
(2.5, "Je donne à ce macaron une note moyenne de 2,5/5. Bien que les couleurs soient attrayantes et la présentation soignée, 
   la texture et le goût n'étaient pas à la hauteur de mes attentes. La coque était un peu trop dure, manquant de ce craquant 
   léger suivi d'un moelleux caractéristique des macarons. Quant à la garniture, elle était correcte en terme de saveur, mais un 
   peu trop sucrée, éclipsant la finesse du biscuit. En résumé, ce macaron avait du potentiel, mais nécessitait une meilleure 
   exécution pour vraiment satisfaire les amateurs de pâtisserie française.", '2023-01-04 18:40:00',4, 1),
(4.0, "Ces cupcakes sont une véritable tentation pour les gourmands. Avec leur texture moelleuse et leur glaçage ni trop 
   sucré ni trop léger, ils offrent une expérience gustative presque parfaite. Idéaux pour accompagner un café ou comme dessert 
   lors d'une fête.", '2023-01-05 16:50:00',5, 1),
(3.5, "Ce brownie est assez satisfaisant pour les amateurs de chocolat. Il a un bon goût de cacao, mais sa texture est un 
   peu sèche, surtout sur les bords. Il serait parfait avec une boule de glace pour ajouter un 
   peu de moelleux.", '2023-01-06 12:15:00',6, 1),
(4.5, "Un cheesecake presque parfait avec sa base croustillante et sa garniture crémeuse. Chaque bouchée est un mélange de 
   douceur et de texture agréable. Idéal pour finir un repas sur une note sucrée.", '2023-01-07 09:20:00',7, 1),
(2.0, "Malheureusement, ce gâteau au chocolat ne répond pas aux attentes. La texture est trop lourde et le goût 
   de chocolat n'est pas assez prononcé. Pourrait être amélioré avec une recette plus aérée et un chocolat de 
   meilleure qualité.", '2023-01-08 20:00:00',8, 1),
(5.0, "Ce steak est un pur délice. La cuisson est parfaite, offrant une viande tendre et juteuse. Chaque bouchée est un 
   plaisir, plein de saveurs naturelles. Idéal pour un dîner spécial ou une occasion festive.", '2023-01-09 14:15:00',9, 1),
(4.0, "Un poulet bien rôti avec une peau croustillante. La chair est tendre, mais manque un peu de jutosité. 
   Le goût est cependant très satisfaisant, surtout avec un bon assaisonnement.", '2023-01-10 17:30:00', 10,1),
(3.5, "Ces saucisses sont de bonne qualité, avec une belle texture et un goût équilibré. Elles manquent 
   cependant d'un petit quelque chose qui les rendrait exceptionnelles. Parfaites pour un barbecue ou une 
   grillade.", '2023-01-11 11:20:00',11, 1),
(3.0, "Les côtes d'agneau sont correctes, mais pas extraordinaires. La viande est tendre, mais pourrait être mieux 
   assaisonnée. Une marinade plus audacieuse pourrait les rendre plus savoureuses.", '2023-01-13 15:30:00',12, 3),
(5.0, "Un rôti de bœuf superbe, avec une viande tendre qui fond dans la bouche. Le goût est riche et satisfaisant, 
   ce qui en fait un plat principal idéal pour les repas en famille ou les dîners festifs.", '2023-01-14 10:40:00',13, 4),
(4.5, "Ce filet de poulet est presque parfait. Cuit à la perfection, il est tendre et juteux. Avec un assaisonnement 
   délicat, il est à la fois simple et délicieux.", '2023-01-15 16:15:00',14, 5),
(2.0, "Ce jambon est plutôt décevant. Il est trop sec et manque de saveur, ce qui le rend moins attrayant 
   pour des plats où le jambon est la star.", '2023-01-16 21:30:00',15, 6),
(4.0, "Le canard entier est rôti à la perfection avec une peau croustillante. La chair est savoureuse, mais 
   pourrait bénéficier d'un peu plus d'assaisonnement pour relever son goût.", '2023-01-17 13:10:00',16, 7),
(4.5, "Ce foie gras est un véritable plaisir pour les papilles. Avec sa texture riche et fondante, il offre une 
   expérience gustative luxueuse. Parfait pour une occasion spéciale ou comme aperitif raffiné", '2023-01-18 09:50:00',17, 8),
(3.0, "Ce vin rouge est agréable mais manque de la complexité et de la profondeur que l'on attend d'un bon cru. 
   Il s'accorde bien avec des plats simples, mais ne se démarque pas particulièrement.", '2023-01-19 18:20:00',19, 9),
(2.5, 'Pas ce que j espérais.', '2023-01-20 16:30:00', 20,10),
(5.0, "Ce champagne est sublime, avec un équilibre parfait et des bulles fines. Il est idéal pour 
   célébrer les grandes occasions.", '2023-01-21 11:45:00',21, 1),
(4.0, "Le vin rosé est léger et fruité, très agréable pour une journée d'été. Il offre une expérience de 
   dégustation rafraîchissante et agréable.", '2023-01-22 20:30:00',22, 2),
(3.5, "Le blé est de bonne qualité avec une texture satisfaisante. Il est assez polyvalent pour diverses utilisations 
   en cuisine, mais il lui manque un petit quelque chose pour se démarquer vraiment.", '2023-01-23 12:15:00',23, 3),
(4.5, "L'orge se distingue par son excellent goût et sa texture parfaite, idéale pour enrichir les soupes et les ragoûts. 
   Son caractère nutritif et sa versatilité en font un incontournable dans la cuisine.", '2023-01-24 17:20:00',24, 4),
(2.5, "Cette farine de seigle est assez moyenne. Bien qu'elle soit utile pour certaines recettes, elle a tendance à 
   rendre les pains un peu trop denses et pourrait bénéficier d'une mouture plus fine.", '2023-01-25 14:00:00',25, 5),
(4.0, "Ce Camembert offre une belle expérience gustative avec sa texture crémeuse et son goût équilibré. Il se 
   marie bien avec du vin et des fruits, bien qu'il pourrait être un peu plus onctueux.", '2023-01-26 09:10:00',26, 6),
(5.0, "Le Roquefort est absolument exquis, avec un goût fort et distinct. Sa texture crémeuse et son arôme riche en 
   font un fromage de choix pour les connaisseurs.", '2023-01-27 15:30:00',27, 7),
(3.0, "Ce Comté est agréable, mais il manque de la profondeur et de l'intensité caractéristiques de ce fromage. 
   Bien pour une utilisation quotidienne, mais pas exceptionnel.", '2023-01-28 18:50:00',28, 8),
(4.5, "Le Brie est délicieusement crémeux, avec un goût riche et une texture fondante. Il est presque parfait, 
   mais pourrait bénéficier d'un peu plus de caractère pour un goût encore plus mémorable.", '2023-01-29 16:40:00',29, 9),
(2.0, "Le fromage de chèvre est décevant avec un goût un peu trop fade et une texture qui laisse à désirer. Il manque 
   de la fraîcheur et de la richesse qu'on attend de ce type de fromage.", '2023-01-30 10:15:00', 30,10),
(5.0, "Ce Gruyère suisse est impeccable avec son goût riche et sa texture parfaite. Chaque bouchée offre une expérience 
   gustative complexe et satisfaisante.", '2023-01-31 12:20:00',31, 1),
(3.5, "La baguette a une bonne croûte croustillante et une mie aérée. Elle est très bonne, mais pourrait bénéficier d'un peu 
   plus de saveur pour être vraiment exceptionnelle.", '2023-02-01 21:05:00',32, 2),
(4.0, "Ces croissants sont délicieusement feuilletés avec une belle texture légère. Ils sont presque parfaits, mais un peu plus 
   de beurre les rendrait irrésistibles.", '2023-02-02 14:30:00',33, 3),
(4.5, "Le pain complet est savoureux et nutritif, avec une excellente texture et une bonne densité. Il est idéal pour un 
   petit-déjeuner sain ou un sandwich nourrissant.", '2023-02-03 09:25:00',34, 4),
(2.5, "La brioche est un peu décevante, manquant de la légèreté et de la douceur caractéristiques. Elle est convenable, 
   mais ne se démarque pas vraiment.", '2023-02-04 17:10:00',35, 5),
(3.0, "Ce pain aux noix est bon, avec une texture agréable et une bonne quantité de noix. Cependant, il pourrait 
   bénéficier d'un peu plus de saveur pour rehausser l'ensemble.", '2023-02-05 11:30:00',36, 6),
(5.0, "Le pain au chocolat est absolument divin, avec une pâte feuilletée parfaite et une garniture au chocolat riche. 
   Chaque bouchée est un pur délice.", '2023-02-06 19:20:00',37, 7),
(4.0, "Le saumon est frais et savoureux, avec une texture moelleuse. Il est très bien préparé, mais pourrait être légèrement 
   plus assaisonné pour en rehausser le goût. " , '2023-02-07 16:45:00',38, 8),
(4.5, 'Un délice pour les papilles.', '2023-02-08 10:30:00',39, 9),
(3.0, 'Acceptable.', '2023-02-09 18:55:00', 39,10),
(4.0, 'Très utile !', '2023-02-10 11:00:00', 1, 1),
(2.5, 'Décevant.', '2023-02-11 14:25:00', 62, 2),
(5.0, 'Parfait !', '2023-02-12 10:00:00', 63, 3),
(4.5, 'J adore.', '2023-02-13 16:35:00', 64, 4),
(3.0, 'Peut mieux faire.', '2023-02-14 18:15:00', 65, 5),
(2.0, 'Pas à la hauteur.', '2023-02-15 20:10:00', 66, 6),
(4.5, 'Vraiment top.', '2023-02-16 09:40:00', 67, 7),
(5.0, 'Je ne peux plus men passer.', '2023-02-17 15:30:00', 68, 8),
(3.5, 'Assez bon.', '2023-02-18 17:45:00', 69, 9),
(4.0, 'Pas mal.', '2023-02-19 19:00:00', 10,10),
(2.5, 'Bof bof.', '2023-02-20 11:20:00', 11, 4),
(4.5, 'Génial !', '2023-02-21 14:10:00', 12, 2),
(5.0, 'Au top !', '2023-02-22 15:55:00', 13, 3),
(3.0, 'Moyen.', '2023-02-23 09:15:00',14, 4),
(2.0, 'Je ne recommande pas.', '2023-02-24 18:20:00', 15, 5),
(4.0, 'Fonctionne bien.', '2023-02-25 10:30:00', 16, 6),
(4.5, 'Excellent produit.', '2023-02-26 16:00:00', 17, 7),
(3.5, 'Ça va.', '2023-02-27 19:45:00', 18, 8),
(5.0, 'Je suis conquis.', '2023-02-28 11:10:00', 19, 9),
(4.0, 'Un régal pour chaque repas.', '2023-03-01 13:05:00', 20,10),
(3.0, 'Pas extraordinaire.', '2023-03-02 15:20:00', 21, 5),
(2.5, 'Pas convaincu.', '2023-03-03 18:50:00',22, 2),
(4.5, 'Un excellent choix.', '2023-03-04 09:45:00', 23, 3),
(5.0, 'Incroyable !', '2023-03-05 14:30:00', 24, 4),
(3.5, 'Correct.', '2023-03-06 17:15:00', 25, 5),
(4.0, 'Je suis satisfait.', '2023-03-07 19:20:00', 26, 6),
(2.0, 'Déçu.', '2023-03-08 10:50:00', 27, 7),
(4.5, 'Je recommande.', '2023-03-09 16:10:00', 28, 8),
(5.0, 'Vraiment super.', '2023-03-10 11:30:00', 29, 9),
(3.0, 'Médiocre.', '2023-03-11 18:05:00', 30,10),
(4.0, 'Bon produit.', '2023-03-12 15:25:00', 31, 1),
(2.5, 'Insatisfaisant.', '2023-03-13 17:40:00', 32, 2),
(5.0, 'Je suis très content.', '2023-03-14 09:20:00', 33, 3),
(4.5, 'Un régal pour chaque repas.', '2023-03-15 16:30:00', 34, 4),
(3.0, 'Fait le job.', '2023-03-16 18:40:00', 35, 5),
(2.0, 'Pas génial.', '2023-03-17 20:25:00',36, 6),
(4.5, 'Parfait pour moi.', '2023-03-18 11:15:00', 37, 7),
(5.0, 'Meilleur achat récent.', '2023-03-19 15:05:00', 38, 8),
(3.5, 'Acceptable.', '2023-03-20 17:20:00', 39, 9),
(4.0, 'Vaut son prix.', '2023-03-21 19:30:00', 40,10),
(3.0, 'Correct, sans plus.', '2023-03-22 10:00:00',41, 1),
(5.0, 'Je l aime beaucoup !', '2023-03-23 14:00:00', 42, 2),
(4.0, 'Tout à fait convenable.', '2023-03-24 11:30:00', 43, 3),
(2.0, 'Pas ce que j attendais.', '2023-03-25 16:45:00', 44, 4),
(3.5, 'Bon rapport qualité-prix.', '2023-03-26 09:10:00', 45, 5),
(4.5, 'Presque parfait.', '2023-03-27 18:30:00', 46, 6),
(2.5, 'Je ne suis pas impressionné.', '2023-03-28 15:40:00', 47, 7),
(4.0, 'Je suis content de mon achat.', '2023-03-29 17:20:00',48, 8),
(5.0, 'Excellent !', '2023-03-30 11:50:00', 49, 9),
(3.0, 'Il y a mieux.', '2023-03-31 16:00:00', 50,10),
(4.5, 'Quasi-parfait.', '2023-04-01 14:25:00', 51, 1),
(2.0, 'N en vaut pas la peine.', '2023-04-02 09:30:00', 52, 2),
(3.5, 'Bien mais peut être amélioré.', '2023-04-03 15:15:00', 53, 3),
(5.0, 'Un régal pour chaque repas ! ', '2023-04-04 18:10:00', 54, 4),
(4.0, 'Solide et fiable.', '2023-04-05 19:30:00', 55, 5),
(3.0, 'Pas le pire, pas le meilleur.', '2023-04-06 11:05:00', 56, 6),
(2.5, 'Peut être amélioré.', '2023-04-07 13:40:00', 57, 7),
(4.5, 'Je suis très satisfait.', '2023-04-08 16:50:00', 58, 8),
(5.0, 'Cela dépasse mes attentes.', '2023-04-09 18:15:00', 59, 9),
(4.0, 'Solide choix.', '2023-04-10 10:45:00', 61,10);




/*--------------------------------------------------------------------
--                                                                  --
--                             Partie GROUPE                        --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/

-- Insertion de relations entre comptes et messages
INSERT INTO GROUPE (Nom_groupe, Image_groupe) VALUES
('Groupe Exemple Ewen', "images/profil_pic/groupeEwen.jpg"),
('Groupe La patisserie Catalon', "images/profil_pic/groupeBoulangerie.png"),
('Groupe Durand Fabrice', "images/profil_pic/profil.png"),
('Groupe Michel Sarah', "images/profil_pic/profil.png"),
('Groupe Lambert Olivier', "images/profil_pic/profil.png"),
('Groupe Garnier Valérie', "images/profil_pic/profil.png"),
('Groupe Fournier Guillaume', "images/profil_pic/profil.png"),
('Groupe Leroy Christine', "images/profil_pic/profil.png"),
('Groupe Perrin Philippe', "images/profil_pic/profil.png"),
('Groupe Simon Bernard', "images/profil_pic/profil.png"),
('Groupe Henry Françoise', "images/profil_pic/profil.png");


/*--------------------------------------------------------------------
--                                                                  --
--                        Partie MESSAGE                            --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/

INSERT INTO MESSAGE (Date_message, Contenu_message, Id_groupe, Id_compte) VALUES
('2023-12-11 13:55:19', 'Bonjour, j''aime beaucoup vos produits !', 1, 1),
('2023-12-11 14:01:15', 'Merci, je suis content que vous les aimiez ! Avez-vous essayé notre nouvelle tarte ?', 1, 18),
('2023-12-11 14:10:09', 'Pas encore, elle est à base de quoi ?', 1, 1),
('2023-12-11 14:15:08', 'C''est une tarte au citron meringuée avec une pointe d''orange , un vrai délice !', 1, 18),
('2023-12-11 14:19:16', 'Ça a l''air délicieux, je vais passer une commande tout de suite.', 1, 1),
('2023-12-11 14:23:55', 'Super ! Vous ne serez pas déçu, je vous le garantis.', 1, 18),
('2023-12-11 14:29:09', 'Je suis sûr que oui. Avez-vous des conseils pour manger la tarte ? ', 1, 1),
('2023-12-11 14:34:09', 'Je recommande de la déguster avec un thé noir car il se marie bien avec le citron.', 1, 18),
('2023-12-11 14:39:45', 'Merci pour le conseil ! Avez-vous des offres spéciales en ce moment ?', 1, 1),
('2023-12-11 14:45:24', 'Oui, nous avons une promotion sur nos muffins. Un acheté, le deuxième à moitié prix.', 1, 18),
('2023-12-11 14:51:56', 'Génial, je vais aussi ajouter quelques muffins à ma commande.', 1, 1),
('2023-12-11 14:54:14', 'Parfait, je suis sûr que vous allez les adorer.', 1, 18),
('2023-12-11 14:59:58', 'Je n''en doute pas.', 1, 1),
('2023-12-11 15:02:21','Je suis ravi de vous annoncer que nous avons lancé une toute nouvelle gamme de muffins, intitulée ''Les Délices d''Arkan''. Ils sont disponibles en plusieurs saveurs, y compris myrtille, chocolat, et banane-noix. Chaque muffin est soigneusement préparé avec des ingrédients de qualité supérieure pour assurer une expérience gustative inégalée. Pour célébrer ce lancement, nous offrons une réduction spéciale : achetez-en un, obtenez le deuxième à moitié prix ! Venez goûter à la différence, je suis sûr que vous serez conquis.', 2, 18);


/*--------------------------------------------------------------------
--                                                                  --
--                             Partie AFFILIER                      --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/



-- Insertion de relations entre comptes et messages 
INSERT INTO AFFILIER (Id_compte ,Id_groupe) VALUES 
(1,1),(18,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(18,2);



/*--------------------------------------------------------------------
--                                                                  --
--                             Partie VUES                          --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/

-- Afficher les Produits des Producteurs et leurs détails 
DROP VIEW IF EXISTS VUE_PRODUIT_PRODUCTEUR;
CREATE VIEW VUE_PRODUIT_PRODUCTEUR AS
SELECT Id_produit, Nom_produit, Prix_produit, Quantite_produit, COMPTE.Id_compte, Nom_compte, Prenom_compte, COMPTE.Adresse_postal_compte, Ville_compte
FROM PRODUIT
INNER JOIN COMPTE ON PRODUIT.Id_compte = COMPTE.Id_compte;

-- Affiche les Commandes clients avec les informations du client
DROP VIEW IF EXISTS VUE_COMMANDE_CLIENT;
CREATE VIEW VUE_COMMANDE_CLIENT AS
SELECT DISTINCT(COMMANDE.Id_commande), 
    COMMANDE.Date_commande, 
    COMMANDE.Date_retrait_commande, 
    COMMANDE.Statut_commande, 
    CLIENT.Id_compte AS Id_client, 
    CLIENT.Nom_compte AS Nom_client, 
    CLIENT.Prenom_compte AS Prenom_client, 
    PRODUCTEUR.Nom_compte AS Nom_producteur,
    PRODUCTEUR.Adresse_postal_compte AS Adresse_postal_producteur,
    PRODUCTEUR.Ville_compte AS Ville_producteur,
    PRODUCTEUR.Code_postal_compte AS Code_postal_producteur
FROM COMMANDE
INNER JOIN COMPTE AS CLIENT ON COMMANDE.Id_compte = CLIENT.Id_compte
INNER JOIN AJOUTER ON COMMANDE.Id_commande = AJOUTER.Id_commande
INNER JOIN PRODUIT ON AJOUTER.Id_produit = PRODUIT.Id_produit
INNER JOIN COMPTE AS PRODUCTEUR ON PRODUIT.Id_compte = PRODUCTEUR.Id_compte;



-- Affiche les avis clients sur un produit avec son détails
DROP VIEW IF EXISTS VUE_AVIS_CLIENT;
CREATE VIEW VUE_AVIS_CLIENT AS
SELECT Id_avis, Note_avis, Commentaire_avis, Date_avis, PRODUIT.Id_produit, Nom_produit, COMPTE.Id_compte, Nom_compte, Prenom_compte, COMPTE.Adresse_postal_compte, Ville_compte
FROM AVIS
INNER JOIN COMPTE ON AVIS.Id_compte = COMPTE.Id_compte
INNER JOIN PRODUIT ON AVIS.Id_produit = PRODUIT.Id_produit;

-- Affiche le détails d'un compte client
DROP VIEW IF EXISTS VUE_CLIENT;
CREATE VIEW VUE_CLIENT AS
SELECT Id_compte, Nom_compte, Prenom_compte, Adresse_email_compte, Num_tel_compte, Adresse_postal_compte, Ville_compte, Code_postal_compte
FROM COMPTE
INNER JOIN ROLE ON COMPTE.Id_role = ROLE.Id_role
WHERE Nom_role = 'Client';

-- Affiche le détails d'un compte producteurs
DROP VIEW IF EXISTS VUE_PRODUCTEURS;
CREATE VIEW VUE_PRODUCTEURS AS
SELECT Id_compte, Nom_compte, Prenom_compte, Nom_producteur, Num_siret_producteur, Adresse_email_compte, Num_tel_compte, Adresse_postal_compte, Ville_compte, Code_postal_compte,Nom_categorie
FROM COMPTE
INNER JOIN ROLE ON COMPTE.Id_role = ROLE.Id_role
INNER JOIN CATEGORIE ON CATEGORIE.Id_categorie=COMPTE.Id_categorie
WHERE Nom_role = 'Producteur';

-- Affiche le détails d'un compte adminstrateur
DROP VIEW IF EXISTS VUE_ADMINISTRATEURS;
CREATE VIEW VUE_ADMINISTRATEURS AS
SELECT Id_compte, Nom_compte, Prenom_compte, Adresse_email_compte, Num_tel_compte, Adresse_postal_compte, Ville_compte, Code_postal_compte
FROM COMPTE
INNER JOIN ROLE ON COMPTE.Id_role = ROLE.Id_role
WHERE Nom_role = 'Administrateur';


SELECT * FROM VUE_PRODUIT_PRODUCTEUR;
SELECT * FROM VUE_COMMANDE_CLIENT;
SELECT * FROM VUE_AVIS_CLIENT;
SELECT * FROM VUE_CLIENT;
SELECT * FROM VUE_PRODUCTEURS;
SELECT * FROM VUE_ADMINISTRATEURS;

/*--------------------------------------------------------------------
--                                                                  --
--                        Partie FAVORIES                            --
--                                                                  --
--                                                                  --
--------------------------------------------------------------------*/

INSERT INTO FAVORIS (Id_compte,Id_produit) VALUES
(1, 50),
(1, 69),
(1, 38),
(1, 34),
(1, 42),
(1, 14),
(1, 6),
(1, 44),
(1, 64),
(1, 43);