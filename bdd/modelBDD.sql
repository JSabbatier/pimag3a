CREATE TABLE `param` (
`id` int NOT NULL AUTO_INCREMENT,
`nom` longtext NULL,
`type_param` longtext NULL,
`val_int` int NULL,
`val_int2` int NULL,
`val_int3` int NULL,
`val_char` longtext NULL,
`val_char2` longtext NULL,
`val_char3` longtext NULL,
`val_float` float NULL,
`val_float2` float NULL,
`val_float3` float NULL,
PRIMARY KEY (`id`) 
);

CREATE TABLE `arrivage` (
`id_lot` int NOT NULL AUTO_INCREMENT,
`date_arrivage` date NULL,
`id_fournisseur` int NULL,
`qualite` int(8) NULL,
`quantite` int NULL,
`numero_tracabilite` varchar(255) NULL,
`validite` varchar(3) NULL,
`prix_achat` float NULL,
`devise` varchar(5) NULL,
`code_barre` int NULL,
`etat` varchar(255) NULL,
`controle` varchar(255) NULL,
PRIMARY KEY (`id_lot`) 
);

CREATE TABLE `commande` (
`id_commande` int NOT NULL AUTO_INCREMENT,
`id_client` int NULL,
`dt_commande` varchar(255) NULL,
`dt_livraison_souhaite` varchar(255) NULL,
`dt_livraison_reel` varchar(255) NULL,
`delai_paiement` int NULL,
`id_commercial` int NULL,
`code_barre` int NULL,
`etat` varchar(255) NULL,
PRIMARY KEY (`id_commande`) 
);

CREATE TABLE `expedition` (
`id` int NULL AUTO_INCREMENT,
`id_commande` int NULL,
`id_lot` int NULL,
`quantite` int NULL,
PRIMARY KEY (`id`) 
);

CREATE TABLE `client` (
`id_client` int NOT NULL AUTO_INCREMENT,
`nom_client` longtext NULL,
`numero_tel` longtext NULL,
`nom_contact` varchar(255) NULL,
`email_contact` varchar(255) NULL,
`raison` varchar(255) NULL,
`id_commercial` int NULL,
`etat` varchar(255) NULL,
PRIMARY KEY (`id_client`) 
);

CREATE TABLE `fournisseur` (
`id_fournisseur` int NOT NULL AUTO_INCREMENT,
`nom_fournisseur` int NULL,
`numero_tel` varchar(45) NULL,
`adresse` varchar(255) NULL,
`fax` varchar(45) NULL,
`contact` varchar(255) NULL,
`email_contact` varchar(255) NULL,
`raison` varchar(255) NULL,
`etat` varchar(255) NULL,
PRIMARY KEY (`id_fournisseur`) 
);

CREATE TABLE `bouchon_A` (
`id` int NOT NULL AUTO_INCREMENT,
`id_arrivage` int NOT NULL,
`longueur` float NULL,
`diametre1` float NULL,
`diametre2` float NULL,
`diametre_compresse` float NULL,
`humidite` int NULL,
PRIMARY KEY (`id`) 
);

CREATE TABLE `bouchon_D` (
`id` int NOT NULL AUTO_INCREMENT,
`id_panier` int NULL,
`numero_tracabilite` longtext NULL,
`longueur` float NULL,
`diametre1` float NULL,
`diametre2` float NULL,
`diametre_compresse` float NULL,
`humidite` float NULL,
PRIMARY KEY (`id`) 
);

CREATE TABLE `panier` (
`id_panier` int NOT NULL AUTO_INCREMENT,
`id_commande` int NULL,
`qualite` int NULL,
`quantite` int NULL,
`longeur` int NULL,
`marquage` varchar(255) NULL,
`prix_negocie` float NULL,
`devise` varchar(5) NULL,
`controle` varchar(255) NULL,
`id_commande_fournisseur` int NULL,
PRIMARY KEY (`id_panier`) 
);

CREATE TABLE `employes` (
`id_employe` int NULL AUTO_INCREMENT,
`nom` varchar(255) NULL,
`prenom` varchar(255) NULL,
`tel` varchar(45) NULL,
`role` varchar(255) NULL,
`adresse` varchar(255) NULL,
`fax` varchar(45) NULL,
`mail` varchar(255) NULL,
`etat` varchar(255) NULL,
PRIMARY KEY (`id_employe`) 
);

CREATE TABLE `mesure_A` (
`id` int NOT NULL AUTO_INCREMENT,
`id_arrivage` int NULL,
`tca_fournisseur` float NULL,
`tca_interne` float NULL,
`gout` varchar(5) NULL,
PRIMARY KEY (`id`) 
);

CREATE TABLE `adresse` (
`id_adresse` int NOT NULL AUTO_INCREMENT,
`id_client` int NULL,
`adresse` varchar(255) NULL,
`nom` varchar(255) NULL,
PRIMARY KEY (`id_adresse`) 
);

CREATE TABLE `commande_fournisseur` (
`id_cmd_fournisseur` int NULL AUTO_INCREMENT,
`id_fournisseur` int NULL,
`dt_commande` datetime NULL,
`dt_livraison` datetime NULL,
`etat` varchar(255) NULL,
PRIMARY KEY (`id_cmd_fournisseur`) 
);

CREATE TABLE `mesure_D` (
`id` int NOT NULL AUTO_INCREMENT,
`id_panier` int NULL,
`tca_interne` float NULL,
`capilarite` float NULL,
`gout` varchar(255) NULL,
PRIMARY KEY (`id`) 
);



ALTER TABLE `commande` ADD CONSTRAINT `fk_commande_client_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);
ALTER TABLE `employes` ADD CONSTRAINT `fk_employes_commande_1` FOREIGN KEY (`id_employe`) REFERENCES `commande` (`id_commercial`);
ALTER TABLE `expedition` ADD CONSTRAINT `fk_expedition_commande_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);
ALTER TABLE `expedition` ADD CONSTRAINT `fk_expedition_arrivage_1` FOREIGN KEY (`id_lot`) REFERENCES `arrivage` (`id_lot`);
ALTER TABLE `arrivage` ADD CONSTRAINT `fk_arrivage_fournisseur_1` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`);
ALTER TABLE `commande` ADD CONSTRAINT `fk_commande_panier_1` FOREIGN KEY (`dt_commande`) REFERENCES `panier` (`id_commande`);
ALTER TABLE `bouchon_A` ADD CONSTRAINT `fk_bouchon_A_arrivage_1` FOREIGN KEY (`id_arrivage`) REFERENCES `arrivage` (`id_lot`);
ALTER TABLE `mesure_A` ADD CONSTRAINT `fk_mesure_arrivage_1` FOREIGN KEY (`id_arrivage`) REFERENCES `arrivage` (`id_lot`);
ALTER TABLE `adresse` ADD CONSTRAINT `fk_adresse_client_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);
ALTER TABLE `bouchon_D` ADD CONSTRAINT `fk_bouchon_D_panier_1` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id_panier`);
ALTER TABLE `mesure_D` ADD CONSTRAINT `fk_mesure_D_panier_1` FOREIGN KEY (`id_panier`) REFERENCES `panier` (`id_panier`);
ALTER TABLE `commande_fournisseur` ADD CONSTRAINT `fk_commande_fournisseur_fournisseur_1` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`);
ALTER TABLE `commande_fournisseur` ADD CONSTRAINT `fk_commande_fournisseur_panier_1` FOREIGN KEY (`id_cmd_fournisseur`) REFERENCES `panier` (`id_commande_fournisseur`);

