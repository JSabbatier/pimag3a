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
`date` date NULL,
`id_fournisseur` int NULL,
`qualite` int(8) NULL,
`quantite` int NULL,
`numero_tracabilite` longtext NULL,
`validite` longtext NULL,
`prix_achat` float NULL,
`devise` longtext NULL,
PRIMARY KEY (`id_lot`) 
);

CREATE TABLE `commande` (
`id_commande` int NOT NULL AUTO_INCREMENT,
`id_client` int NULL,
`id_panier` int NULL,
`dt_commande` varchar(255) NULL,
`dt_livraison_souhaite` varchar(255) NULL,
`dt_livraison_reel` varchar(255) NULL,
`delai_paiement` int NULL,
`id_commercial` int NULL,
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
`numeroTel` longtext NULL,
`adresse` longtext NULL,
PRIMARY KEY (`id_client`) 
);

CREATE TABLE `fournisseur` (
`id_fournisseur` int NOT NULL AUTO_INCREMENT,
`nom_fournisseur` int NULL,
`numero_tel` longtext NULL,
PRIMARY KEY (`id_fournisseur`) 
);

CREATE TABLE `controle_A` (
`id` int NOT NULL AUTO_INCREMENT,
`id_lot` int NOT NULL,
`longueur` float NULL,
`diametre1` float NULL,
`diametre2` float NULL,
`diametre_compresse` float NULL,
`humidite` int NULL,
`tca_intern` int NULL,
`tca_fournisseur` int NULL,
`gout` varchar(3) NULL,
PRIMARY KEY (`id`) 
);

CREATE TABLE `controle_D` (
`id` int NOT NULL AUTO_INCREMENT,
`id_lot` int NULL,
`numero_tracabilite` longtext NULL,
`longueur` float NULL,
`diametre1` float NULL,
`diametre2` float NULL,
`capilarite` int NULL,
`tca_interne` int NULL,
`gout` varchar(3) NULL,
PRIMARY KEY (`id`) 
);

CREATE TABLE `panier` (
`id_panier` int NOT NULL AUTO_INCREMENT,
`id_commande` int NULL,
`qualite` int NULL,
`quantite` int NULL,
`marquage` longtext NULL,
`prix_negocie` float NULL,
`devise` longtext NULL,
PRIMARY KEY (`id_panier`) 
);

CREATE TABLE `employes` (
`id_employe` int NULL AUTO_INCREMENT,
`nom` varchar(255) NULL,
`prenom` longtext NULL,
`tel` longtext NULL,
`role` longtext NULL,
`adresse` longtext NULL,
`fax` longtext NULL,
`mail` longtext NULL,
PRIMARY KEY (`id_employe`) 
);


ALTER TABLE `commande` ADD CONSTRAINT `fk_commande_client_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);
ALTER TABLE `arrivage` ADD CONSTRAINT `fk_arrivage_controle_D_1` FOREIGN KEY (`id_lot`) REFERENCES `controle_D` (`id_lot`);
ALTER TABLE `arrivage` ADD CONSTRAINT `fk_arrivage_controle_A_1` FOREIGN KEY (`id_lot`) REFERENCES `controle_A` (`id_lot`);
ALTER TABLE `employes` ADD CONSTRAINT `fk_employes_commande_1` FOREIGN KEY (`id_employe`) REFERENCES `commande` (`id_commercial`);
ALTER TABLE `expedition` ADD CONSTRAINT `fk_expedition_commande_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`);
ALTER TABLE `expedition` ADD CONSTRAINT `fk_expedition_arrivage_1` FOREIGN KEY (`id_lot`) REFERENCES `arrivage` (`id_lot`);
ALTER TABLE `arrivage` ADD CONSTRAINT `fk_arrivage_fournisseur_1` FOREIGN KEY (`id_fournisseur`) REFERENCES `fournisseur` (`id_fournisseur`);
ALTER TABLE `panier` ADD CONSTRAINT `fk_panier_commande_1` FOREIGN KEY (`id_panier`) REFERENCES `commande` (`id_panier`);

