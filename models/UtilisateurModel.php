<?php
class Utilisateur {
    private $id;
    private $nom ;
    private $prenom;
    private $email;
    private $tel;
    private $adresse;
    private $code_ville;

    // Constructeur pour initialiser un utilisateur
    public function __construct($id="?", $email="?",$nom="?",$prenom="?",$tel="?",$adresse="?",$code_ville="?") {
        $this->id = $id;
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->tel = $tel;
        $this->adresse = $adresse;
        $this->code_ville = $code_ville;

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
                $utilisateur['code_ville']
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
    
}
?>