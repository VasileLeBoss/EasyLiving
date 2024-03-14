CREATE TABLE arrondissement(
   arrondiss_dem INT,
   PRIMARY KEY(arrondiss_dem)
);

CREATE TABLE utilisateur(
   id_utilisateur INT auto_increment,
   email VARCHAR(50) NOT NULL,
   mdp VARCHAR(255) NOT NULL,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50) NOT NULL,
   adresse VARCHAR(50) NOT NULL,
   tel VARCHAR(20),
   code_ville VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_utilisateur),
   UNIQUE(email)
);

CREATE TABLE appartement_temp(
   numappart_temp INT,
   step_ INT,
   rue VARCHAR(50),
   arrondisse INT,
   etage INT,
   typappart VARCHAR(10),
   prix_loc DECIMAL(10,2),
   prix_charg DECIMAL(10,2),
   ascenseur BOOLEAN ,
   preavis BOOLEAN ,
   date_libre DATE ,
   id_utilisateur INT,
   PRIMARY KEY(numappart_temp),
   UNIQUE(id_utilisateur),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE appartements(
   numappart INT,
   rue VARCHAR(50),
   arrondisse INT NOT NULL,
   etage INT,
   typappart VARCHAR(10) NOT NULL,
   prix_loc DECIMAL(10,2),
   prix_charg DECIMAL(10,2),
   ascenseur BOOLEAN DEFAULT true,
   preavis BOOLEAN DEFAULT false,
   date_libre DATE NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(numappart),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE locataires(
   numeroloc INT,
   nom_loc VARCHAR(30) NOT NULL,
   prenom_loc VARCHAR(20) NOT NULL,
   datenaiss DATE NOT NULL,
   tel_loc VARCHAR(20),
   r_i_b INT NOT NULL,
   tel_banque VARCHAR(20),
   numappart INT NOT NULL,
   PRIMARY KEY(numeroloc),
   UNIQUE(numappart),
   FOREIGN KEY(numappart) REFERENCES appartements(numappart)
);

CREATE TABLE demandes(
   num_dem INT auto_increment,
   dateArrivee DATE,
   dateDepart DATE,
   numappart INT NOT NULL,
   id_utilisateur INT NOT NULL,
   PRIMARY KEY(num_dem),
   FOREIGN KEY(numappart) REFERENCES appartements(numappart),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);


CREATE TABLE visiter(
   numappart INT,
   id_utilisateur INT,
   date_visite DATE,
   PRIMARY KEY(numappart, id_utilisateur),
   FOREIGN KEY(numappart) REFERENCES appartements(numappart),
   FOREIGN KEY(id_utilisateur) REFERENCES utilisateur(id_utilisateur)
);

CREATE TABLE concerner(
   num_dem INT,
   arrondiss_dem INT,
   PRIMARY KEY(num_dem, arrondiss_dem),
   FOREIGN KEY(num_dem) REFERENCES demandes(num_dem),
   FOREIGN KEY(arrondiss_dem) REFERENCES arrondissement(arrondiss_dem)
);

DELIMITER //
CREATE PROCEDURE createtempappartement(IN utilisateur_id INT)
BEGIN
    INSERT INTO appartement_temp (numappart_temp, step, rue, arrondisse, etage, typappart, prix_loc, prix_charg, ascenseur, preavis, date_libre, id_utilisateur)
    VALUES (utilisateur_id, 1, null, null, null, null, null, null, null, null, null, utilisateur_id);
END //
DELIMITER ;

DELIMITER $$
-- Créer un déclencheur après insertion d'un utilisateur
CREATE TRIGGER after_insert_utilisateur
AFTER INSERT ON utilisateur
FOR EACH ROW
BEGIN
    -- Appeler la procédure stockée pour insérer des informations supplémentaires
    CALL createtempappartement(NEW.id_utilisateur);
END $$
DELIMITER;
