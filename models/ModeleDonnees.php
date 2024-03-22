<?php
include_once('AppartementModel.php');
include('ConnexionDB.php');
include('ConnexionDB_lecture.php');
include('ConnexionDB_ecriture.php');
class ModeleDonnees
{
	private $laConnexion ;
	private $monPDOstatique ; 
	
	public function __construct($type)
	{
			switch($type)
			{
				case 'lecture':
				{
					$this->monPDOstatique = ConnexionDB_lecture::ouvreConnexion(); 
					$this->monPDOstatique = $this->monPDOstatique->get_monPDO(); 
					break;
				}
				case 'ecriture':
				{
					$this->monPDOstatique = ConnexionDB_ecriture::ouvreConnexion(); 
					$this->monPDOstatique = $this->monPDOstatique->get_monPDO(); 
					break;
				}
				default:
				{
					$_SESSION['erreur']="Connexion SGBD impossible";
					header("Location: ../view/erreur.php");
				}
			} 
	}
	public function controleEmailDejaExistant($email)
    {
        try {
            $requete = "SELECT COUNT(*) FROM utilisateur WHERE email = :email";
            $ordre = $this->monPDOstatique->prepare($requete);
            $ordre->bindParam(':email', $email, PDO::PARAM_STR);
            $ordre->execute();
            $nb = $ordre->fetchColumn();
            return $nb; 
        } catch (PDOException $e) {
            
            die("Erreur lors de la vérification de l'e-mail existant : " . $e->getMessage());
        }
    }
	public function insertUtilisateur($email, $mdp, $nom, $prenom, $tel, $adresse, $code_ville)
	{
		try {
			// Étendre la requête pour inclure toutes les informations
			$requete = "INSERT INTO utilisateur (email, mdp, nom, prenom,  adresse, tel, code_ville) 
						VALUES (:email, :mdp, :nom, :prenom, :adresse, :tel,  :code_ville, :role)";
			
			$ordre = $this->monPDOstatique->prepare($requete);
	
			// Liens pour les paramètres
			$ordre->bindParam(':email', $email, PDO::PARAM_STR);
			$ordre->bindParam(':mdp', $mdp, PDO::PARAM_STR);
			$ordre->bindParam(':nom', $nom, PDO::PARAM_STR);
			$ordre->bindParam(':prenom', $prenom, PDO::PARAM_STR);
			$ordre->bindParam(':tel', $tel, PDO::PARAM_STR);  
			$ordre->bindParam(':adresse', $adresse, PDO::PARAM_STR);
			$ordre->bindParam(':code_ville', $code_ville, PDO::PARAM_STR); 
			$ordre->bindParam(':role','user', PDO::PARAM_STR); 
			$ordre->execute();
			
			return $ordre->rowCount();
		} catch (PDOException $e) {
			// Gestion des erreurs
			die("Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage());
		}
	}
	
	public function verifierLoginMdP($email, $mdp) {
		try {
			$requete = "SELECT id_utilisateur, email, mdp, nom, prenom, adresse, tel, code_ville,role FROM utilisateur WHERE email = :email";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(':email', $email, PDO::PARAM_STR);
			$ordre->execute();
			$utilisateur = $ordre->fetch(PDO::FETCH_ASSOC);
	
			// Vérifier le mot de passe avec password_verify
			if ($utilisateur && password_verify($mdp, $utilisateur['mdp'])) {

				unset($utilisateur['mdp']); 
				return $utilisateur;
			}
	
			return false;
		} catch (PDOException $e) {
			// Utilisez une exception plutôt que die
			throw new Exception("Erreur lors de la vérification du login et du mot de passe : " . $e->getMessage());
		}
	}

	public function getUtilisateurByEmail($email) {
        try {
            $requete = "SELECT id_utilisateur, email, nom, prenom, adresse, tel, code_ville,role FROM utilisateur WHERE email = :email";
            $ordre = $this->monPDOstatique->prepare($requete);
            $ordre->bindParam(':email', $email, PDO::PARAM_STR);
            $ordre->execute();

            $resultat = $ordre->fetch(PDO::FETCH_ASSOC);

            return $resultat; // Renvoie les informations de l'utilisateur ou false s'il n'est pas trouvé
        } catch (PDOException $e) {
            
            die("Erreur lors de la récupération de l'utilisateur par e-mail : " . $e->getMessage());
        }
    }

	public function getAllUtilisateurs() {
        try {
            $requete = "SELECT id_utilisateur, email, nom, prenom, adresse, tel, code_ville,role FROM utilisateur";
            $ordre = $this->monPDOstatique->prepare($requete);
            $ordre->execute();

            $resultat = $ordre->fetchAll(PDO::FETCH_ASSOC);

            return $resultat; 
        } catch (PDOException $e) {
            
            die("Erreur lors de la récupération de l'utilisateur par e-mail : " . $e->getMessage());
        }
    }
	public function getAppartementTempUtilisateur($idUtilisateur)
	{
		try {
			$requete = "SELECT * FROM appartement_temp WHERE id_utilisateur = :idUtilisateur";
	
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
			$ordre->execute();
			$resultats = $ordre->fetch(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultats;
		} catch (PDOException $e) {
			// Gérer les erreurs
			die("Erreur lors de la récupération de l'appartement temporaire : " . $e->getMessage());
		}
	}
	public function getAnnonceTriebyUtilsateurId($id,$colonne) {
        try {
            $requete = "SELECT * FROM appartements WHERE id_utilisateur = :id and $colonne = :colonne";
            $ordre = $this->monPDOstatique->prepare($requete);
            $ordre->bindParam(':id', $id, PDO::PARAM_INT);
			$ordre->bindParam(':colonne', $colonne, PDO::PARAM_STR);
            $ordre->execute();

            $resultat = $ordre->fetch(PDO::FETCH_ASSOC);

            return $resultat; // Renvoie les informations de l'utilisateur ou false s'il n'est pas trouvé
        } catch (PDOException $e) {
            
            die("Erreur lors de la récupération de l'utilisateur par e-mail : " . $e->getMessage());
        }
    }
	public function enregistrerAppartementTemp_step_1($idUtilisateur, $step, $type_appartement) {
		try {
				$requete = "UPDATE appartement_temp 
							SET step = ?, typappart = ?
							WHERE id_utilisateur = ?";
	
				$ordre = $this->monPDOstatique->prepare($requete);
				$ordre->bindParam(1, $step, PDO::PARAM_INT);
				$ordre->bindParam(2, $type_appartement, PDO::PARAM_STR);
				$ordre->bindParam(3, $idUtilisateur, PDO::PARAM_INT);
	
				$resultat = $ordre->execute();
				$ordre->closeCursor();
	
				return $resultat;
		} catch (PDOException $e) {
			die("Erreur lors de la mise à jour : " . $e->getMessage());
		}
	}
	public function enregistrerAppartementTemp_step_2($idUtilisateur, $step, $arrondisse, $etage,$rue) {
		try {
			$requete = "UPDATE appartement_temp 
						SET step = ?, arrondisse = ?, etage = ?,rue = ?
						WHERE id_utilisateur = ?";
	
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(1, $step, PDO::PARAM_INT);
			$ordre->bindParam(2, $arrondisse, PDO::PARAM_STR);
			$ordre->bindParam(3, $etage, PDO::PARAM_INT);
			$ordre->bindParam(4, $rue, PDO::PARAM_STR);
			$ordre->bindParam(5, $idUtilisateur, PDO::PARAM_INT);
			$resultat = $ordre->execute();
			$ordre->closeCursor();
	
			return $resultat;
		} catch (PDOException $e) {
			die("Erreur lors de la mise à jour : " . $e->getMessage());
		}
	}
	public function enregistrerAppartementTemp_step_3($id_utilisateur, $step, $preavis,$ascenseur,$date_libre) {
		try {
			$requete = "UPDATE appartement_temp 
						SET step = ?, preavis = ?, ascenseur = ?, date_libre =?
						WHERE id_utilisateur = ?";
						
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(1, $step, PDO::PARAM_INT);
			$ordre->bindParam(2, $preavis, PDO::PARAM_BOOL);  
			$ordre->bindParam(3, $ascenseur, PDO::PARAM_BOOL);  
			$ordre->bindParam(4, $date_libre, PDO::PARAM_STR);  
			$ordre->bindParam(5, $id_utilisateur, PDO::PARAM_INT);
			$resultat = $ordre->execute();
			$ordre->closeCursor();
			return $resultat;
		} catch (PDOException $e) {
			die("Erreur lors de la mise à jour : " . $e->getMessage());
		}
	}
	public function enregistrerAppartementTemp_step_4($id_utilisateur, $step, $prix_loc,$prix_charge) {
		try {
			$requete = "UPDATE appartement_temp 
						SET step = ?, prix_loc = ?, prix_charg = ?
						WHERE id_utilisateur = ?";
	
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(1, $step, PDO::PARAM_INT);
			$ordre->bindParam(2, $prix_loc, PDO::PARAM_STR);
			$ordre->bindParam(3, $prix_charge, PDO::PARAM_STR);
			$ordre->bindParam(4, $id_utilisateur, PDO::PARAM_INT);
			$resultat = $ordre->execute();
			$ordre->closeCursor();
			return $resultat;
		} catch (PDOException $e) {
			die("Erreur lors de la mise à jour : " . $e->getMessage());
		}
	}
	// public function enregistrerAppartementTemp_step_5($id_utilisateur, $step, $imageNom)
	// {
	// 	try {
	// 		$requete = "UPDATE appartement_temp 
	// 					SET step = ?, image_nom = ?
	// 					WHERE id_utilisateur = ?";
	
	// 		$ordre = $this->monPDOstatique->prepare($requete);
	// 		$ordre->bindParam(1, $step, PDO::PARAM_INT);
	// 		$ordre->bindParam(2, $imageNom, PDO::PARAM_STR);
	// 		$ordre->bindParam(3, $id_utilisateur, PDO::PARAM_STR);

	// 		$resultat = $ordre->execute();
	// 		$ordre->closeCursor();
	// 		return $resultat;
	// 	} catch (PDOException $e) {
	// 		die("Erreur lors de la mise à jour : " . $e->getMessage());
	// 	}
	// }
	public function enregistrerAppartement($appartement) {
		try {
			$requete = "INSERT INTO appartements(rue, arrondisse, etage, typappart, prix_loc, prix_charg, ascenseur, preavis, date_libre, id_utilisateur) VALUES (?,?,?,?,?,?,?,?,?,?)";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $appartement->getRue());
			$ordre->bindValue(2, $appartement->getArrondissement());
			$ordre->bindValue(3, $appartement->getEtage());
			$ordre->bindValue(4, $appartement->getTypAppart());
			$ordre->bindValue(5, $appartement->getPrixLoc());
			$ordre->bindValue(6, $appartement->getPrixCharg());
			$ordre->bindValue(7, $appartement->getAscenseur());
			$ordre->bindValue(8, $appartement->getPreavis());
			$ordre->bindValue(9, $appartement->getDateLibre());
			$ordre->bindValue(10, $appartement->getIdUtilisateur());
			
			$resultat = $ordre->execute();
			// Renvoyer true si l'enregistrement réussit
			return $resultat;
		} catch (PDOException $e) {
			error_log("Erreur lors de l'enregistrement : " . $e->getMessage(), 0);
			return false;
		}
	}
	

	
	public function resetAppartementTemp($id_utilisateur)
	{
		try {
			$requete = "UPDATE appartement_temp
						SET step = 0,
							rue = null,
							arrondisse = null,
							etage = null,
							typappart = null,
							prix_loc = null,
							prix_charg = null,
							ascenseur = null,
							preavis = null,
							date_libre = null
						WHERE id_utilisateur = ?";
	
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(1, $id_utilisateur, PDO::PARAM_INT);
			$ordre->execute();
			$ordre->closeCursor();
		} catch (PDOException $e) {
			die("Erreur lors de la réinitialisation : " . $e->getMessage());
		}
	}
	
	public function GetAllAppartements()
	{
		try
		{
			$requete = "SELECT * FROM appartements ORDER BY numappart DESC;
			";
			$ordre = $this->monPDOstatique->prepare($requete);
	
			$ordre->execute();

			$resultats = $ordre->fetchAll(PDO::FETCH_ASSOC);
	
			$ordre->closeCursor();

			return $resultats;
		}
		catch (PDOException $e) {
			die("Erreur lors de la réinitialisation : " . $e->getMessage());
		}
	}
	public function GetAllAppartementsbyIdUtilisateur($id)
	{
		try
		{
			// Utilisez des guillemets simples pour les chaînes SQL
			$requete = "SELECT * FROM appartements WHERE id_utilisateur = :id ORDER BY numappart DESC";
	
			$ordre = $this->monPDOstatique->prepare($requete);
			
			$id = intval($id);
			
			$ordre->bindValue(':id', $id);
			$ordre->execute();

			$resultats = $ordre->fetchAll(PDO::FETCH_ASSOC);
			
			return $resultats;
		}
		catch (PDOException $e) {
			// Loguez l'erreur ou lancez une exception personnalisée
			die("Erreur lors de la réinitialisation : " . $e->getMessage());
		}
	}
	

	public function updateInfoPersoUtilisateurBDD($id, $email, $nom, $prenom, $tel, $adresse, $code_ville)
	{
		try {
			$requete = "UPDATE utilisateur SET email = :email, nom = :nom, prenom = :prenom, tel = :tel, 
			adresse = :adresse, code_ville = :code_ville WHERE id_utilisateur = :id";
	
			$ordre = $this->monPDOstatique->prepare($requete);
	
			$ordre->bindValue(':id', $id);
			$ordre->bindValue(':email', $email);
			$ordre->bindValue(':nom', $nom);
			$ordre->bindValue(':prenom', $prenom);
			$ordre->bindValue(':tel', $tel);
			$ordre->bindValue(':adresse', $adresse);
			$ordre->bindValue(':code_ville', $code_ville);
	
			$ordre->execute();
			$ordre->closeCursor();

			return $ordre;
		} catch (PDOException $e) {
			die("Erreur lors de la mise à jour : " . $e->getMessage());
		}
	}
	public function getHashedPasswordById($idUtilisateur)
	{
		try {
			$requete = "SELECT mdp FROM utilisateur WHERE id_utilisateur = :idUtilisateur";
	
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetch(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat['mdp'];
		} catch (PDOException $e) {
			die("Erreur lors de la récupération du mot de passe : " . $e->getMessage());
		}
	}
	public function updatePasswordById($idUtilisateur, $newmdp)
	{
		try {
			$requete = "UPDATE utilisateur SET mdp = :newmdp WHERE id_utilisateur = :idUtilisateur";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
			$ordre->bindParam(':newmdp', $newmdp, PDO::PARAM_STR);
			$success = $ordre->execute();
			$ordre->closeCursor();
			return $success;
		} catch (PDOException $e) {
			die("Erreur lors de la mise à jour du mot de passe : " . $e->getMessage());
		}
	}
	
	public function searchannoncewhituserid($request, $idUtilisateur)
	{
		try {
			$requestWithWildcard = '%' . $request . '%';
			$requete = "SELECT * FROM appartements WHERE (rue LIKE :request OR arrondisse LIKE :request or typappart LIKE :request) AND id_utilisateur = :idUtilisateur";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(':request', $requestWithWildcard, PDO::PARAM_STR);
			$ordre->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
			$success = $ordre->execute();
	
			if (!$success) {
				return false; // Indiquer que la recherche a échoué
			}
			$resultats = $ordre->fetchAll(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultats;
		} catch (PDOException $e) {
			die("Erreur lors de la recherche d'annonces : " . $e->getMessage());
		}
	}
	
	public function getAnnoncebyID($id)
	{
		try {
			$requete = "SELECT * FROM appartements WHERE numappart = :id";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindParam(':id', $id, PDO::PARAM_INT);
			$success = $ordre->execute();
			$resultat = $ordre->fetch(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat !== false ? $resultat : null;
		} catch (PDOException $e) {
			die("Erreur lors de la recherche d'annonces : " . $e->getMessage());
		}
	}
	
	public function UpdateAnnonceById($numappart, $prixLoc, $prixCharg, $dateLibre) {
		try {
			$requete = "UPDATE appartements SET prix_loc = ?, prix_charg = ?, date_libre = ? WHERE numappart = ?";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $prixLoc, PDO::PARAM_INT);
			$ordre->bindValue(2, $prixCharg, PDO::PARAM_INT);            
			$ordre->bindValue(3, $dateLibre->format('Y-m-d'));  // Utilisation de format pour obtenir une chaîne de caractères
			$ordre->bindValue(4, $numappart, PDO::PARAM_INT);
			// Exécution de la requête
			$resultat = $ordre->execute();
	
			return $resultat;
		} catch (PDOException $e) {
			error_log("Erreur lors de l'enregistrement : " . $e->getMessage());
			return false;
		}
	}
	public function DeleteAnnonceById($numappart) {
		try {
			
			$requete = "DELETE FROM appartements WHERE numappart = ?";
			$ordre = $this->monPDOstatique->prepare($requete);
			
			
			$ordre->bindValue(1, $numappart, PDO::PARAM_INT);
	
			
			$resultat = $ordre->execute();
	
			return $resultat;
		} catch (PDOException $e) {
			error_log("Erreur lors de la suppression de l'annonce : " . $e->getMessage());
			return false;
		}
	}

	
	public function GetAllAppartementsbyType($typappart)
	{
		try
		{
			$requete = "SELECT * FROM appartements where typappart = ? ORDER BY numappart DESC;";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $typappart, PDO::PARAM_STR);
			$ordre->execute();
			$resultats = $ordre->fetchAll(PDO::FETCH_ASSOC);
			$ordre->closeCursor();

			return $resultats;
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}


	public function demandeReservation($dateArrivee, $dateDepart, $idAppartement, $id_demandeur,$id_proprieter) {
		try {
			$requete = "INSERT INTO demandes(dateArrivee, dateDepart, numappart, id_demandeur, id_proprieter) VALUES (?, ?, ?, ?, ?)";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $dateArrivee, PDO::PARAM_STR);
			$ordre->bindValue(2, $dateDepart, PDO::PARAM_STR);
			$ordre->bindValue(3, $idAppartement, PDO::PARAM_INT);
			$ordre->bindValue(4, $id_demandeur, PDO::PARAM_INT);
			$ordre->bindValue(5, $id_proprieter, PDO::PARAM_INT);

			$resultat = $ordre->execute();
	
			// Si l'enregistrement échoue, une exception PDOException sera levée
			return true;
		} catch (PDOException $e) {
			// Vous pouvez enregistrer l'erreur dans le journal
			error_log("Erreur lors de l'enregistrement : " . $e->getMessage(), 0);
	
			// Vous pouvez relancer l'exception ou renvoyer false en fonction de votre logique
			throw $e;
		}
	}
	public function isReservedByUser($numappart, $id_utilisateur)
	{
		try
		{
			$requete = "SELECT COUNT(*) AS count FROM demandes WHERE numappart = ? AND id_demandeur = ? ;";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $numappart, PDO::PARAM_INT);
			$ordre->bindValue(2, $id_utilisateur, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetch(PDO::FETCH_ASSOC);
			$ordre->closeCursor();

			// Utilisez le résultat de COUNT pour déterminer si des réservations existent
			return $resultat['count'] > 0;
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}
	public function getNombreDemandes($id_proprieter)
	{
		try
		{
			$requete = "SELECT COUNT(*) AS count FROM demandes WHERE id_proprieter = ?  and status != 'ecl' ;";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $id_proprieter, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetch(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			if ($resultat['count']>0) {
				return $resultat['count'];
			}
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}
	
	public function getNombreDemandesAppartementById($id_appartement)
	{
		try
		{
			$requete = "SELECT COUNT(*) as count FROM demandes WHERE numappart = ? and status != 'ecl' ";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $id_appartement, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetch(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			if ($resultat['count']>0) {
				return $resultat['count'];
			}
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}
	

	public function getNombreLocataireAppartementById($id_appartement)
	{
		try
		{
			$requete = "SELECT COUNT(*) as count FROM demandes WHERE numappart = ? and status = 'ecl' ";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $id_appartement, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetch(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			if ($resultat['count']>0) {
				return $resultat['count'];
			}
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}


	public function getAllDemandesAppartementById($id_appartement)
	{
		try
		{
			$requete = "SELECT * FROM demandes WHERE numappart = ?";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $id_appartement, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetchAll(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat;
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}

	public function getAllLocatairesAppartementById($id_appartement)
	{
		try
		{
			$requete = "SELECT * FROM demandes WHERE numappart = ? and status ='ecl' order by dateArrivee ";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $id_appartement, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetchAll(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat;
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}

	public function getDemandeurById($id_demandeur)
	{
		try
		{
			$requete = "SELECT u.id_utilisateur, u.email, u.nom, u.prenom, u.adresse, u.tel, u.code_ville,u.role
			FROM utilisateur u
			JOIN demandes d ON u.id_utilisateur = d.id_demandeur
			WHERE d.id_demandeur = ?
			LIMIT 1 ;";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $id_demandeur, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetch(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat;
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}
	public function getproprieterById($id_proprieter)
	{
		try
		{
			$requete = "SELECT u.id_utilisateur, u.email, u.nom, u.prenom, u.adresse, u.tel, u.code_ville,u.role
			FROM utilisateur u
			JOIN demandes d ON u.id_utilisateur = d.id_proprieter
			WHERE d.id_proprieter = ?
			LIMIT 1 ;";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $id_proprieter, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetch(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat;
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}
	
	public function getAllDemandes()
	{
		try 
		{
			$requete = "SELECT * FROM demandes ORDER BY `num_dem`";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->execute();
			$resultat = $ordre->fetchAll(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat;
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}
	public function getAllDemandesUtilisateur($id_utilisateur)
	{
		try
		{
			$requete = "SELECT * FROM demandes WHERE id_demandeur = ? ORDER BY `num_dem` DESC";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $id_utilisateur, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetchAll(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat;
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}
	public function DeleteDemandeById($num_demande) {
		try {
			$requete = "DELETE FROM demandes WHERE num_dem = ?";
			$ordre = $this->monPDOstatique->prepare($requete);
	
			$ordre->bindValue(1, $num_demande, PDO::PARAM_INT);
	
			$resultat = $ordre->execute();
	
			return $resultat;    
		} catch (PDOException $e) {
			error_log("Erreur PDO lors de la suppression de la demande : " . $e->getMessage());
			return false;
		}
	}
	public function UpdateStatusDemandeById($num_demande,$status) {
		try {
			$requete = "UPDATE demandes set status = ? WHERE num_dem = ?";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $status, PDO::PARAM_STR);
			$ordre->bindValue(2, $num_demande, PDO::PARAM_INT);
	
			$resultat = $ordre->execute();
	
			return $resultat;    
		} catch (PDOException $e) {
			error_log("Erreur PDO lors de la suppression de la demande : " . $e->getMessage());
			return false;
		}
	}	
	

	


	public function InsertNewLocater($nom_loc, $prenom_loc, $tel_loc, $num_cpte_banque, $banque, $adress_banque, $code_ville_banque, $tel_banque, $numappart)
	{
		try {
			// Étendre la requête pour inclure toutes les informations
			$requete = "INSERT INTO locataires (nom_loc, prenom_loc, tel_loc, num_cpte_banque, banque, adress_banque, code_ville_banque, tel_banque, numappart) 
						VALUES (:nom_loc, :prenom_loc, :tel_loc, :num_cpte_banque, :banque, :adress_banque, :code_ville_banque, :tel_banque, :numappart)";
			
			$ordre = $this->monPDOstatique->prepare($requete);
	
			// Liens pour les paramètres
			$ordre->bindParam(':nom_loc', $nom_loc, PDO::PARAM_STR);
			$ordre->bindParam(':prenom_loc', $prenom_loc, PDO::PARAM_STR);
			$ordre->bindParam(':tel_loc', $tel_loc, PDO::PARAM_STR);  
			$ordre->bindParam(':num_cpte_banque', $num_cpte_banque, PDO::PARAM_STR);
			$ordre->bindParam(':banque', $banque, PDO::PARAM_STR);
			$ordre->bindParam(':adress_banque', $adress_banque, PDO::PARAM_STR);
			$ordre->bindParam(':code_ville_banque', $code_ville_banque, PDO::PARAM_STR);
			$ordre->bindParam(':tel_banque', $tel_banque, PDO::PARAM_STR);
			$ordre->bindParam(':numappart', $numappart, PDO::PARAM_STR);
	
			$ordre->execute();
			
			if ($ordre->rowCount() > 0) {
				return $ordre->rowCount();
			} else {
				return 0;
			}
			
		} catch (PDOException $e) {
			die("Erreur lors de l'insertion de l'utilisateur : " . $e->getMessage());
		}
	}

	public function UpdateDateDisponibleAppartement($num_app,$date_libre) {
		try {
			$requete = "UPDATE appartements set date_libre = ? WHERE numappart = ?";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $date_libre, PDO::PARAM_STR);
			$ordre->bindValue(2, $num_app, PDO::PARAM_INT);
	
			$resultat = $ordre->execute();
	
			return $resultat;    
		} catch (PDOException $e) {
			error_log("Erreur PDO lors de la suppression de la demande : " . $e->getMessage());
			return false;
		}
	}	



	public function restrictedDateRangesFromDatabase($numappart)
	{
		try
		{
			$requete = "SELECT dateArrivee,dateDepart FROM demandes WHERE numappart = ?";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $numappart, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetchAll(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat;
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}

	public function revenuUtilisateur($id_utilisateur)
	{
		try
		{
			$requete = "SELECT d.dateArrivee,d.dateDepart, a.prix_loc,a.prix_charg FROM demandes d JOIN appartements a ON d.numappart = a.numappart WHERE STATUS = 'ecl' AND id_proprieter = ?";
			$ordre = $this->monPDOstatique->prepare($requete);
			$ordre->bindValue(1, $id_utilisateur, PDO::PARAM_INT);
			$ordre->execute();
			$resultat = $ordre->fetchAll(PDO::FETCH_ASSOC);
			$ordre->closeCursor();
			return $resultat;
			
		}
		catch (PDOException $e) {
			error_log("Erreur lors de la recherche : " . $e->getMessage());
			return false;
		}
	}

	public function chercheAppartement3criter($arrondisse, $prix_max, $prix_min)
{
    try {
        $requete = "SELECT * 
                    FROM appartements 
                    WHERE (:arrondisse = 0 OR arrondisse = :arrondisse)
                    AND (:prix_max = 0 OR (prix_loc + prix_charg) <= :prix_max)
                    AND (:prix_min = 0 OR (prix_loc + prix_charg) >= :prix_min)";
        
        $ordre = $this->monPDOstatique->prepare($requete);
        $ordre->bindValue(':arrondisse', $arrondisse, PDO::PARAM_INT);
        $ordre->bindValue(':prix_max', $prix_max, PDO::PARAM_INT);
        $ordre->bindValue(':prix_min', $prix_min, PDO::PARAM_INT);
        $ordre->execute();
        $resultat = $ordre->fetchAll(PDO::FETCH_ASSOC);
        $ordre->closeCursor();
        return $resultat;
    } catch (PDOException $e) {
        error_log("Erreur lors de la recherche : " . $e->getMessage());
        return false;
    }
}

	

}// fin classe
?>
