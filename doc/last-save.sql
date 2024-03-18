-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour vb_gsb_2
CREATE DATABASE IF NOT EXISTS `vb_gsb_2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `vb_gsb_2`;

-- Listage de la structure de table vb_gsb_2. appartements
CREATE TABLE IF NOT EXISTS `appartements` (
  `numappart` int NOT NULL AUTO_INCREMENT,
  `rue` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `arrondisse` int NOT NULL,
  `etage` int DEFAULT NULL,
  `typappart` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prix_loc` decimal(10,2) DEFAULT NULL,
  `prix_charg` decimal(10,2) DEFAULT NULL,
  `ascenseur` tinyint(1) DEFAULT '0',
  `preavis` tinyint(1) DEFAULT '0',
  `date_libre` date NOT NULL,
  `id_utilisateur` int NOT NULL,
  PRIMARY KEY (`numappart`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `appartements_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.appartements : ~11 rows (environ)
INSERT INTO `appartements` (`numappart`, `rue`, `arrondisse`, `etage`, `typappart`, `prix_loc`, `prix_charg`, `ascenseur`, `preavis`, `date_libre`, `id_utilisateur`) VALUES
	(4, 'test ', 7, 2, 'bateau', 50.00, 10.00, 0, 1, '2023-12-31', 2),
	(8, 'j\'en ai marre ', 20, 1000, 'bateau', 900.00, 1000.00, 0, 0, '2023-12-27', 2),
	(10, 'un nom d\'une rue duplex', 1, 22, 'duplex', 70.00, 30.00, 0, 0, '2023-12-29', 2),
	(12, 'dernier rue', 20, 1, 'hotel', 80855515.85, 2.00, 1, 1, '2023-12-31', 2),
	(13, 'test Paris', 3, 5, 'appartement', 40.00, 20.00, 0, 1, '2024-08-10', 5),
	(16, 'je suis pas creative', 20, 1, 'bateau', 200.00, 20.00, 1, 1, '2024-01-27', 5),
	(17, 'rue de vasile ', 10, 5, 'bateau', 60.00, 50.00, 1, 1, '2024-02-11', 5),
	(23, 'penthause', 16, 10, 'penthouse', 30.00, 8.00, 1, 1, '2024-06-01', 1),
	(24, 'iness', 12, 75, 'penthouse', 7200896.00, 1.00, 0, 0, '3000-01-22', 8),
	(26, 'je suis pas creative', 4, 20, 'hotel', 160.00, 80.00, 1, 0, '2024-03-09', 1),
	(28, 'hgttu xu-ru xyrux hyy', 7, 4353, 'penthouse', 0.00, 0.00, 0, 0, '2025-10-24', 9);

-- Listage de la structure de table vb_gsb_2. appartement_temp
CREATE TABLE IF NOT EXISTS `appartement_temp` (
  `numappart_temp` int NOT NULL,
  `step` int DEFAULT NULL,
  `rue` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `arrondisse` int DEFAULT NULL,
  `etage` int DEFAULT NULL,
  `typappart` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prix_loc` decimal(10,2) DEFAULT NULL,
  `prix_charg` decimal(10,2) DEFAULT NULL,
  `ascenseur` tinyint(1) DEFAULT NULL,
  `preavis` tinyint(1) DEFAULT NULL,
  `date_libre` date DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`numappart_temp`),
  UNIQUE KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `appartement_temp_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.appartement_temp : ~10 rows (environ)
INSERT INTO `appartement_temp` (`numappart_temp`, `step`, `rue`, `arrondisse`, `etage`, `typappart`, `prix_loc`, `prix_charg`, `ascenseur`, `preavis`, `date_libre`, `id_utilisateur`) VALUES
	(1, 3, 'je suis pas creative ', 14, 0, 'hotel', NULL, NULL, 1, 0, '2024-03-10', 1),
	(2, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2),
	(3, 2, '69 rue de chateau', 20, 0, 'bateau', NULL, NULL, NULL, NULL, NULL, 3),
	(4, 1, NULL, NULL, NULL, 'duplex', NULL, NULL, NULL, NULL, NULL, 4),
	(5, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
	(6, 4, 'Avenue Paul vaillant', 1, 2, 'hotel', 80.00, 20.00, 1, 0, '2024-02-04', 6),
	(7, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7),
	(8, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8),
	(9, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9),
	(10, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10);

-- Listage de la structure de table vb_gsb_2. arrondissement
CREATE TABLE IF NOT EXISTS `arrondissement` (
  `arrondiss_dem` int NOT NULL,
  PRIMARY KEY (`arrondiss_dem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.arrondissement : ~0 rows (environ)

-- Listage de la structure de table vb_gsb_2. concerner
CREATE TABLE IF NOT EXISTS `concerner` (
  `num_dem` int NOT NULL,
  `arrondiss_dem` int NOT NULL,
  PRIMARY KEY (`num_dem`,`arrondiss_dem`),
  KEY `arrondiss_dem` (`arrondiss_dem`),
  CONSTRAINT `concerner_ibfk_1` FOREIGN KEY (`num_dem`) REFERENCES `demandes` (`num_dem`),
  CONSTRAINT `concerner_ibfk_2` FOREIGN KEY (`arrondiss_dem`) REFERENCES `arrondissement` (`arrondiss_dem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.concerner : ~0 rows (environ)

-- Listage de la structure de procédure vb_gsb_2. createtempappartement
DELIMITER //
CREATE PROCEDURE `createtempappartement`(
	IN `utilisateur_id` INT
)
BEGIN
    INSERT INTO appartement_temp (numappart_temp, step, rue, arrondisse, etage, typappart, prix_loc, prix_charg, ascenseur, preavis, date_libre, id_utilisateur)
    VALUES (utilisateur_id, 0, null, null, null, null, null, null, null, null, NULL, utilisateur_id);
END//
DELIMITER ;

-- Listage de la structure de table vb_gsb_2. demandes
CREATE TABLE IF NOT EXISTS `demandes` (
  `num_dem` int NOT NULL AUTO_INCREMENT,
  `dateArrivee` date DEFAULT NULL,
  `dateDepart` date DEFAULT NULL,
  `numappart` int NOT NULL,
  `id_demandeur` int NOT NULL,
  `id_proprieter` int NOT NULL,
  `status` varchar(3) COLLATE utf8mb4_general_ci DEFAULT 'ea',
  PRIMARY KEY (`num_dem`),
  KEY `numappart` (`numappart`),
  KEY `id_demandeur` (`id_demandeur`),
  KEY `id_proprieter` (`id_proprieter`),
  CONSTRAINT `demandes_ibfk_1` FOREIGN KEY (`numappart`) REFERENCES `appartements` (`numappart`),
  CONSTRAINT `demandes_ibfk_2` FOREIGN KEY (`id_demandeur`) REFERENCES `utilisateur` (`id_utilisateur`),
  CONSTRAINT `demandes_ibfk_3` FOREIGN KEY (`id_proprieter`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.demandes : ~1 rows (environ)
INSERT INTO `demandes` (`num_dem`, `dateArrivee`, `dateDepart`, `numappart`, `id_demandeur`, `id_proprieter`, `status`) VALUES
	(32, '2024-05-09', '2024-06-01', 23, 2, 1, 'ecl');

-- Listage de la structure de table vb_gsb_2. image
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `nom_fishier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `chemin_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.image : ~0 rows (environ)

-- Listage de la structure de table vb_gsb_2. locataires
CREATE TABLE IF NOT EXISTS `locataires` (
  `numeroloc` int NOT NULL AUTO_INCREMENT,
  `nom_loc` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom_loc` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `tel_loc` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `num_cpte_banque` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `banque` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adress_banque` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code_ville_banque` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tel_banque` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `numappart` int NOT NULL,
  PRIMARY KEY (`numeroloc`),
  KEY `numappart` (`numappart`),
  CONSTRAINT `locataires_ibfk_1` FOREIGN KEY (`numappart`) REFERENCES `appartements` (`numappart`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.locataires : ~1 rows (environ)
INSERT INTO `locataires` (`numeroloc`, `nom_loc`, `prenom_loc`, `tel_loc`, `num_cpte_banque`, `banque`, `adress_banque`, `code_ville_banque`, `tel_banque`, `numappart`) VALUES
	(1, 'Pasvasile', 'Nonplus', '2555225255', '11545848125', 'adad', '75 rue paris ', '88448', '1188455155', 23);

-- Listage de la structure de table vb_gsb_2. tj_image_appart
CREATE TABLE IF NOT EXISTS `tj_image_appart` (
  `numappart` int NOT NULL,
  `id_image` int NOT NULL,
  PRIMARY KEY (`numappart`,`id_image`),
  KEY `id_image` (`id_image`),
  CONSTRAINT `tj_image_appart_ibfk_1` FOREIGN KEY (`numappart`) REFERENCES `appartements` (`numappart`),
  CONSTRAINT `tj_image_appart_ibfk_2` FOREIGN KEY (`id_image`) REFERENCES `image` (`id_image`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.tj_image_appart : ~0 rows (environ)

-- Listage de la structure de l'évènement vb_gsb_2. update_status_event
DELIMITER //
CREATE EVENT `update_status_event` ON SCHEDULE EVERY 1 DAY STARTS '2024-03-10 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
    UPDATE demandes
    SET status = 'ex'
    WHERE dateArrivee < CURDATE()
    AND status = 'ea';
END//
DELIMITER ;

-- Listage de la structure de table vb_gsb_2. utilisateur
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `adresse` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code_ville` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.utilisateur : ~10 rows (environ)
INSERT INTO `utilisateur` (`id_utilisateur`, `email`, `mdp`, `nom`, `prenom`, `adresse`, `tel`, `code_ville`) VALUES
	(1, 'vasile.bors.03@gmail.com', '$2y$10$JGLTU1ZQ7NP5788Q2Omt4.BwLPk3acbCkKILJ1/.4jUzBY/gyf4xG', 'Bugneac', 'Vasile', '69 rue turbigo', '0599525251', '75003'),
	(2, 'vasile.bors@protonmail.com', '$2y$10$ABSGd/y7n2LIDGxNoX/DWO9Ggc3WufWh/10b9t1hZRWVnRKgQ69We', 'Pasvasile', 'Nonplus', '7 je sqia pas', '2555225255', '85888'),
	(3, 'vasile.bors.03@mail.ru', '$2y$10$fBrK2dECvtJUuONawU21yenSQBR1VhsclqANNcCPUDxObth/jQBx2', 'test', 'test', '7 je sqia pas', '0555050555', '57557'),
	(4, 'vasile.bugneac@gmail.com', '$2y$10$hFImwGbn6yUgguQq6.aNVuUHX.MDWp5DN3.Uey4zd0snLPLdGCNXa', 'test', 'vasile', '7 avenue ', '5151552000', '55114'),
	(5, 'borsvasile012@gmail.com', '$2y$10$l8z2PLqspJVMKzWnNxqE6uAhQkV4C6gdEwyLmoDFh/.C9reOq6jO6', 'Lowercase', 'Testlowercase', '7 aveneu to lowercase', '0555215154', '95332'),
	(6, 'fffff@gmail.com', '$2y$10$Fgt7ZbcCNwgWWHxGKJoINOPxoJhWjIYgxqlQFVkHNDsKvU9/7WXAq', 'ba', 'lucas', '28 rue des francs bourgeois', '0651245454', '75003'),
	(7, 'md97@daz.ez', '$2y$10$yxNbiPPVRvK0GgzIx8ipbesIUhQgC.67m6VppQDxqmcGcUO1EAdka', 'O', 'Nonon', '3 rue de turbigo', '3212332222', '85000'),
	(8, 'maxlamnecae@gamil.sida', '$2y$10$0WWqyet36cofLGVp41TdIeGBJ2dxgLNrQ66gP.BXmE/2Xi6mDeTLK', 'sida-man', 'man', '4747415582568752874514 rue des maladies ', '3212321664', '54254'),
	(9, 'daniellastinka@gmail.com', '$2y$10$yS3Z1cvfin5vm/Tvm8DRUeQXrL2r8952hwsN9k0sv2jXVHgbpmtda', 'stinca', 'stinca', '12 lala  gryetr ', '0783725585', '00000'),
	(10, 'iness.safady@gmail.com', '$2y$10$PKruXvo0REF/2cVXmAf6Cub/wjt23TQ5vFI8KqdvC.9Y0k2THFnzO', 'safady', 'inessssss', '6 parvis du breuil ', '0323587888', '98989');

-- Listage de la structure de table vb_gsb_2. visiter
CREATE TABLE IF NOT EXISTS `visiter` (
  `numappart` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `date_visite` date DEFAULT NULL,
  PRIMARY KEY (`numappart`,`id_utilisateur`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `visiter_ibfk_1` FOREIGN KEY (`numappart`) REFERENCES `appartements` (`numappart`),
  CONSTRAINT `visiter_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table vb_gsb_2.visiter : ~0 rows (environ)

-- Listage de la structure de déclencheur vb_gsb_2. after_insert_utilisateur
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `after_insert_utilisateur` AFTER INSERT ON `utilisateur` FOR EACH ROW BEGIN
    -- Appeler la procédure stockée pour insérer des informations supplémentaires
    CALL createtempappartement(NEW.id_utilisateur);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
