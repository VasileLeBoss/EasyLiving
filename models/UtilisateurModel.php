<?php
class Utilisateur {
    private $id;
    private $nom ;
    private $prenom;
    private $email;
    private $tel;
    private $adresse;
    private $code_ville;
    private $role;

    // Constructeur pour initialiser un utilisateur
    public function __construct($id="?", $email="?",$nom="?",$prenom="?",$tel="?",$adresse="?",$code_ville="?",$role="?") {
        $this->id = $id;
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->tel = $tel;
        $this->adresse = $adresse;
        $this->code_ville = $code_ville;
        $this->role = $role;

    }

    
    public function getId() {
        return $this->id;
    }
    public function getTel() {
        return $this->tel;
    }
    public function getAdresse() {
        return $this->adresse;
    }
    public function getCodeVille() {
        return $this->code_ville;
    }

    public function getRole() {
        return $this->role;
    }
    
    public function getNomComplet() {
        return $this->prenom . ' ' . $this->nom;
    }
    public function getNom() {
        return $this->nom;
    }
    public function getPrenom() {
        return $this->prenom ;
    }
    
    public function getEmail() {
        return $this->email;
    }

    public static function estConnecte() {
        return isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] instanceof Utilisateur;
    }

    public static function estAdmin() {
       
        return self::estConnecte() && $_SESSION['utilisateur']->getRole() === 'admin';
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTel($tel) {
        $this -> tel = $tel;
    }

    public function setAdresse($adresse) {
        $this -> adresse = $adresse;
    }

    public function setCodeVille($code_ville) {
        $this -> code_ville = $code_ville;
    }
    public function verifyReservation($numappart, $id_utilisateur) {
        require_once('../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        $result = $monModele->isReservedByUser($numappart, $id_utilisateur);
        if ($result === true) {
            return true;
        }
        return false;
    }
    
    public function getNombreDemandesUtilisateur()
    {
        require_once('../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        $result = $monModele->getNombreDemandes($this->getId());
        return $result;
    }
    
    public function getDemandeurById($id_demandeur)
    {
        require_once('../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        $result = $monModele->getDemandeurById($id_demandeur);
        return $result;
    }

    public function createUtilisateur($utilisateur) {
        if (!empty($utilisateur)) {
            return new Utilisateur(
                $utilisateur['id_utilisateur'],
                $utilisateur['email'],
                $utilisateur['nom'],
                $utilisateur['prenom'],
                $utilisateur['tel'],
                $utilisateur['adresse'],
                $utilisateur['code_ville'],
                $utilisateur['role']
            );
        }

        return null;
    }
    public function getAllDemandesUtilisateur()
    {
        require_once('../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        $result = $monModele->getAllDemandesUtilisateur($this->getId());
        return $result;
    }

    public function calculeRevenuUtilisateur()
    {
        require_once('../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        $revenuUtilisateur = $result = $monModele->revenuUtilisateur($this->getId());
        
        $revenuTotal = 0;

        foreach ($revenuUtilisateur as $revenu) {
            
            $dateArrivee = new DateTime($revenu['dateArrivee']);
            $dateDepart = new DateTime($revenu['dateDepart']);
            $nombreJours = $dateDepart->diff($dateArrivee)->days + 1;

            
            $revenuTotal += ($revenu['prix_loc'] + $revenu['prix_charg']) * $nombreJours;
        }
        return $revenuTotal;


    }
    public function revenusParMoisUtilisateur()
{
    // Initialiser un tableau pour stocker les revenus par mois
    $revenusParMois = [];

    require_once('../models/ModeleDonnees.php');
    $monModele = new ModeleDonnees('lecture');

    $revenuUtilisateur = $monModele->revenuUtilisateur($this->getId());

    // Parcourir les revenus de l'utilisateur
    foreach ($revenuUtilisateur as $revenu) {
        // Extraire le mois et l'année de la date d'arrivée
        $moisAnnee = date('Y-m', strtotime($revenu['dateArrivee']));

        // Calculer le revenu pour cet élément
        $dateArrivee = new DateTime($revenu['dateArrivee']);
        $dateDepart = new DateTime($revenu['dateDepart']);
        $nombreJours = $dateDepart->diff($dateArrivee)->days + 1;
        $revenuElement = ($revenu['prix_loc'] + $revenu['prix_charg']) * $nombreJours;

        // Ajouter le revenu au mois correspondant dans le tableau
        if (isset($revenusParMois[$moisAnnee])) {
            $revenusParMois[$moisAnnee] += $revenuElement;
        } else {
            $revenusParMois[$moisAnnee] = $revenuElement;
        }
    }

    // Retourner le tableau des revenus par mois
    return $revenusParMois;
}

    public function calculeRevenuTotalMoisCourant()
    {
        $revenusParMois = $this->revenusParMoisUtilisateur();
    
        $moisAnneeCourant = date('Y-m');
    
        $revenuTotalMoisCourant = 0;
    
        foreach ($revenusParMois as $moisAnnee => $revenu) {
            if ($moisAnnee === $moisAnneeCourant) {
                $revenuTotalMoisCourant += $revenu;
            }
        }
            
        return $revenuTotalMoisCourant;
    }
    

    public function formaterMoisAnnee($date)
    {
        $dateTime = new DateTime($date);
    
        $formatter = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            null,
            null,
            'MMM'
        );
    
        return $formatter->format($dateTime);
    }

    public function formaterDateDemande($date)
    {
        $dateTime = new DateTime($date);
    
        $formatter = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            null,
            null,
            'dd-MM-yyyy'
        );
    
        return $formatter->format($dateTime);
    }
    
    public function getAllUtilisateurs()
    {
        if (Utilisateur::estAdmin()) 
        {
            require_once('../../models/ModeleDonnees.php');
            $monModele = new ModeleDonnees('lecture');
            $results = $monModele->getAllUtilisateurs();
            $utilisateurs=[];
            foreach($results as $utilisateur)
            {
                $newUser = new Utilisateur;
                $utilisateurs[]= $newUser->createUtilisateur($utilisateur);
            }
            
        
            return $utilisateurs;
        }

        return false;
    }
    public function GetAllAppartements()
    {
        if (Utilisateur::estAdmin()) 
        {
            require_once('../../models/ModeleDonnees.php');
            $monModele = new ModeleDonnees('lecture');
            $results = $monModele->GetAllAppartements();
            $Appartements=[];
            foreach($results as $Appartement)
            {
                $newAppartement = new Appartement;
                $Appartements[]= $newAppartement->createAppartementFromAnnonce($Appartement);
            }
            
        
            return $Appartements;
        }

        return false;
    }
    public function getAllDemandes()
    {
        if (Utilisateur::estAdmin()) 
        {
            require_once('../../models/ModeleDonnees.php');
            $monModele = new ModeleDonnees('lecture');
            $results = $monModele->getAllDemandes();
            
            return $results;
        }
    
        return false;
    }

    public function calculeAdminRevenuUtilisateur() {

        if (Utilisateur::estAdmin()) 
        {
        require_once('../../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        $revenuUtilisateur = $monModele->revenuUtilisateur($this->getId());
        $revenuTotal = 0;
    
        foreach ($revenuUtilisateur as $revenu) {
            $dateArrivee = new DateTime($revenu['dateArrivee']);
            $dateDepart = new DateTime($revenu['dateDepart']);
            $nombreJours = $dateDepart->diff($dateArrivee)->days + 1;
    
            $revenuTotal += ($revenu['prix_loc'] + $revenu['prix_charg']) * $nombreJours;
        }
        return $revenuTotal;
    }
    return false;
    }


}
?>