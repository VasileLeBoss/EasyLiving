<?php
class Appartement {
    private $numappart;
    private $step;
    private $rue;
    private $arrondissement;
    private $etage;
    private $typappart;
    private $prixLoc;
    private $prixCharg;
    private $ascenseur;
    private $preavis;
    private $dateLibre;
    private $idUtilisateur;

    public function __construct(
        $numappart = null,
        $step = null,
        $rue = null,
        $arrondissement = null,
        $etage = null,
        $typappart = null,
        $prixLoc = null,
        $prixCharg= null,
        $ascenseur= null,
        $preavis = null,
        $dateLibre= null,
        $idUtilisateur = null
    ) {
        $this->numappart = $numappart;
        $this->step = $step;
        $this->rue = $rue;
        $this->arrondissement = $arrondissement;
        $this->etage = $etage;
        $this->typappart = $typappart;
        $this->prixLoc = $prixLoc;
        $this->prixCharg = $prixCharg;
        $this->ascenseur = $ascenseur;
        $this->preavis = $preavis;
        $this->dateLibre = $dateLibre;
        $this->idUtilisateur = $idUtilisateur;
    }
    public function getStep() {
        return $this->step;
    }
    public function getNumappart() {
        return $this->numappart;
    }

    public function getRue() {
        return $this->rue;
    }

    public function getArrondissement() {
        return $this->arrondissement;
    }

    public function getEtage() {
        return $this->etage;
    }

    public function getTypappart() {
        return $this->typappart;
    }
    public function getPrixLoc() {
        return $this->prixLoc;
    }

    public function getPrixCharg() {
        return $this->prixCharg;
    }
    public function getPrixTotal() {
        return $this->prixCharg + $this->prixLoc;
    }

    public function getAscenseur() {
        return $this->ascenseur;
    }

    public function getPreavis() {
        return $this->preavis;
    }

    public function getDateLibre() {
        
        return $this->dateLibre;
    }
    public function getDateLibreAjour() {
        // Récupérez la date d'aujourd'hui
        $aujourdhui = new DateTime();
        
        // Récupérez la date stockée
        $dateLibre = new DateTime($this->dateLibre);
    
        // Vérifiez si la date stockée est inférieure à la date d'aujourd'hui
        if ($dateLibre < $aujourdhui) {
            // Si c'est le cas, retournez la date d'aujourd'hui
            return $aujourdhui->format('Y-m-d');
        } else {
            // Sinon, retournez la date stockée
            return $this->dateLibre;
        }
    }
    public function getDateReservationMin() {
        
        $dateLibre = new DateTime($this->getDateLibreAjour());
    
        
        if ($this->getPreavis()==1) 
        {
            $dateLibre->add(new DateInterval('P7D'));
        }
        else
        {
            $dateLibre->add(new DateInterval('P1D'));
        }
       
        return $dateLibre->format('Y-m-d');
    }
    
    public function getDateFormated()
    {
        $dateTime = new DateTime($this->dateLibre);
    
        $formatter = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            null,
            null,
            'd MMMM yyyy'
        );
    
        return $formatter->format($dateTime);
    }


    public function FormatDate($date)
    {
        $dateTime = new DateTime($date);
    
        $formatter = new IntlDateFormatter(
            'fr_FR',
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE,
            null,
            null,
            'd MMMM yyyy'
        );
    
        return $formatter->format($dateTime);
    }

    
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }
    public function setNumappart($numappart) {
        $this->numappart = $numappart;
    }
    public function setStep($step) {
        $this->step = $step;
    }

    public function setRue($rue) {
        $this->rue = $rue;
    }

    public function setArrondissement($arrondissement) {
        $this->arrondissement = $arrondissement;
    }

    public function setEtage($etage) {
        $this->etage = $etage;
    }

    public function setTypappart($typappart) {
        $this->typappart = $typappart;
    }

    public function setPrixLoc($prixLoc) {
        $this->prixLoc = $prixLoc;
    }

    public function setPrixCharg($prixCharg) {
        $this->prixCharg = $prixCharg;
    }

    public function setAscenseur($ascenseur) {
        $this->ascenseur = $ascenseur;
    }

    public function setPreavis($preavis) {
        $this->preavis = $preavis;
    }

    public function setDateLibre($dateLibre) {
        $this->dateLibre = $dateLibre;
    }

        
    public function getNombreDemandesAppartementById()
    {
        require_once('../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        $result = $monModele->getNombreDemandesAppartementById($this->getNumappart());
        return $result;
    }
    public function getNombreLocataireAppartementById()
    {
        require_once('../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        $result = $monModele->getNombreLocataireAppartementById($this->getNumappart());
        return $result;
    }

    function createAppartementFromAnnonce($annonce) {
        if (!empty($annonce)) {
            return new Appartement(
                $annonce['numappart'],
                '',
                $annonce['rue'],
                $annonce['arrondisse'],
                $annonce['etage'],
                $annonce['typappart'],
                $annonce['prix_loc'],
                $annonce['prix_charg'],
                $annonce['ascenseur'],
                $annonce['preavis'],
                $annonce['date_libre'],
                $annonce['id_utilisateur']
            );
        }
    
        return null;
    }
    function calculerNombreNuits($dateArrivee, $dateDepart) {
        // Convertir les chaînes de date en objets DateTime
        $arrivee = new DateTime($dateArrivee);
        $depart = new DateTime($dateDepart);
    
        // Calculer la différence en jours
        $difference = $depart->diff($arrivee);
    
        // Retourner le nombre de nuits
        return $difference->days;
    }

    function calculerGagnePotentielle($nbNuit, $prixParNuit)
    {
        
        $nbNuit = max(0, (int)$nbNuit);
        $prixParNuit = max(0, (float)$prixParNuit);
    
        
        $gagnePotentielle = $nbNuit * $prixParNuit;
    
        $gagnePotentielle = $gagnePotentielle;
        return $gagnePotentielle;
    }

    function calculerLesTaxes($gagnePotentielle)
    {
        $gagne = max(0, (float)$gagnePotentielle);
        $Taxes = $gagne * 0.07;

        return $Taxes;
    }

    function calculerGagneReel($gagnePotentielle,$taxes)
    {
        $gagne = max(0, (float)$gagnePotentielle);

        $gagneReel = $gagne - $taxes;

        return $gagneReel;
    }

    function datesDejaReservee($numappart)
    {
        require_once('../models/ModeleDonnees.php');
        $monModele = new ModeleDonnees('lecture');
        $result = $monModele->restrictedDateRangesFromDatabase($numappart);
        return $result;
    }

}


?>