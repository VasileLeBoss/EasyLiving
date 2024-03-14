<?php
include('../models/AppartementModel.php');
require_once('../models/UtilisateurModel.php');
session_start();
include('../models/ModeleDonnees.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['form-annonce'])) 
    {
        $etape = isset($_POST['form-annonce']) ? $_POST['form-annonce'] : null;    
    
        switch ($etape) {
            case 'structure':
               
                $type_appartement = $_POST['type_appartement'];
                $id_utilisateur = $_SESSION['utilisateur']->getId();
                $step = 1;
                $monModele = new ModeleDonnees('ecriture');
                $result = $monModele->enregistrerAppartementTemp_step_1($id_utilisateur, $step, $type_appartement);
                if ($result) {
                    $monModele = new ModeleDonnees('lecture');
                    $donnees = $monModele->getAppartementTempUtilisateur($_SESSION['utilisateur']->getId());
                    $appart_temp = new Appartement(
                        $donnees['numappart_temp'],
                        $donnees['step'],
                        $donnees['rue'],
                        $donnees['arrondisse'],
                        $donnees['etage'],
                        $donnees['typappart'],
                        $donnees['prix_loc'],
                        $donnees['prix_charg'],
                        $donnees['ascenseur'],
                        $donnees['preavis'],
                        $donnees['date_libre'],
                        $donnees['id_utilisateur']
                    );
                    $_SESSION['appart_temp']=$appart_temp;
                    header("Location: ../view/v_depot-annonce-location.php");
                    exit();
                } else {
                    $_SESSION['erreur'] = "Erreur lors de l'enregistrement des données.";
                    header("Location: ../view/v_erreur.php");
                    exit();
                }
                break;
            case 'location':
                $rue = $_POST['rue'];
                $arrondissement = $_POST['arrondissement'];
                $etage = $_POST['etage'];
                $id_utilisateur = $_SESSION['utilisateur']->getId();
                $step = 2;
                $monModele = new ModeleDonnees('ecriture');
                $result = $monModele->enregistrerAppartementTemp_step_2($id_utilisateur, $step, $arrondissement,$etage,$rue);
                if ($result) {
                    $monModele = new ModeleDonnees('lecture');
                    $donnees = $monModele->getAppartementTempUtilisateur($_SESSION['utilisateur']->getId());
                    $appart_temp = new Appartement(
                        $donnees['numappart_temp'],
                        $donnees['step'],
                        $donnees['rue'],
                        $donnees['arrondisse'],
                        $donnees['etage'],
                        $donnees['typappart'],
                        $donnees['prix_loc'],
                        $donnees['prix_charg'],
                        $donnees['ascenseur'],
                        $donnees['preavis'],
                        $donnees['date_libre'],
                        $donnees['id_utilisateur']
                    );
                    $_SESSION['appart_temp']=$appart_temp;
                    header("Location: ../view/v_depot-annonce-access.php");
                    exit();
                } else {
                    $_SESSION['erreur'] = "Erreur lors de l'enregistrement des données. Veuillez réessayer.";
                    header("Location: ../view/v_erreur.php");
                    exit();
                }
                break;  
                case 'access':
                    $preavis = $_POST['preavis'];
                    $date_libre = $_POST['date_libre'];
                    $ascenseur = $_POST['ascenseur'];
                    $id_utilisateur = $_SESSION['utilisateur']->getId();
                    $step = 3;
                    $monModele = new ModeleDonnees('ecriture');

                    $result = $monModele->enregistrerAppartementTemp_step_3($id_utilisateur, $step, $preavis,$ascenseur,$date_libre);
                    if ($result) {
                        $monModele = new ModeleDonnees('lecture');
                        $donnees = $monModele->getAppartementTempUtilisateur($_SESSION['utilisateur']->getId());
                        $appart_temp = new Appartement(
                            $donnees['numappart_temp'],
                            $donnees['step'],
                            $donnees['rue'],
                            $donnees['arrondisse'],
                            $donnees['etage'],
                            $donnees['typappart'],
                            $donnees['prix_loc'],
                            $donnees['prix_charg'],
                            $donnees['ascenseur'],
                            $donnees['preavis'],
                            $donnees['date_libre'],
                            $donnees['id_utilisateur']
                        );
                        $_SESSION['appart_temp']=$appart_temp;
                        header("Location: ../view/v_depot-annonce-prix.php");
                        exit();
                    } else {
                        $_SESSION['erreur'] = "Erreur lors de l'enregistrement des données. Veuillez réessayer.";
                        header("Location: ../view/v_erreur.php");
                        exit();
                    }
                    break;  
            case 'prix':
                $prix_loc = $_POST['prix_loc'];
                $prix_charge = $_POST['prix_charg'];
                $step = 4;
                $id_utilisateur = $_SESSION['utilisateur']->getId();
                $monModele = new ModeleDonnees('ecriture');
                $result = $monModele->enregistrerAppartementTemp_step_4($id_utilisateur, $step, $prix_loc,$prix_charge);
                if ($result) {
                    $monModele = new ModeleDonnees('lecture');
                    $donnees = $monModele->getAppartementTempUtilisateur($_SESSION['utilisateur']->getId());
                    $appart_temp = new Appartement(
                        $donnees['numappart_temp'],
                        $donnees['step'],
                        $donnees['rue'],
                        $donnees['arrondisse'],
                        $donnees['etage'],
                        $donnees['typappart'],
                        $donnees['prix_loc'],
                        $donnees['prix_charg'],
                        $donnees['ascenseur'],
                        $donnees['preavis'],
                        $donnees['date_libre'],
                        $donnees['id_utilisateur']
                    );
                    $_SESSION['appart_temp']=$appart_temp;
                    header("Location: ../view/v_depot-annonce-confirmation.php");
                    exit();
                } else {
                    $_SESSION['erreur'] = "Erreur lors de l'enregistrement des données. Veuillez réessayer.";
                    header("Location: ../view/v_erreur.php");
                    exit();
                }
                break;
                // case 'image':
                //     $step = 5;
                //     $dossierDestination = "../uploads/";
                //     $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
                
                //     $nouveauNomFichier = uniqid('image_') . '.' . $extension;
                
                //     $cheminDestination = $dossierDestination . $nouveauNomFichier;
                
                //     if (move_uploaded_file($_FILES["image"]["tmp_name"], $cheminDestination)) {
                //         // Enregistrez le chemin dans la base de données
                //         $cheminBDD = $cheminDestination;


                //         $id_utilisateur = $_SESSION['utilisateur']->getId();
                //         $monModele = new ModeleDonnees('ecriture');
                //         $result = $monModele->enregistrerAppartementTemp_step_5($id_utilisateur, $step, $nouveauNomFichier);


                //         $appart_temp = new Appartement(
                //             $donnees['numappart_temp'],
                //             $donnees['step'],
                //             $donnees['rue'],
                //             $donnees['arrondisse'],
                //             $donnees['etage'],
                //             $donnees['typappart'],
                //             $donnees['prix_loc'],
                //             $donnees['prix_charg'],
                //             $donnees['ascenseur'],
                //             $donnees['preavis'],
                //             $donnees['date_libre'],
                //             $donnees['id_utilisateur']
                //         );
                //         header("Location: ../view/v_depot-annonce-confirmation.php");
                //         exit();
                //     } else {
                //         $_SESSION['erreur'] = "Erreur lors de l'enregistrement des données. Veuillez réessayer.";
                //         header("Location: ../view/v_erreur.php");
                //         exit();
                //     }
                //     break;
                
            case 'enregistrer':
                    $monModele = new ModeleDonnees('ecriture');
                    if (isset($_SESSION['utilisateur'])) {
                        $resultatEnregistrement = $monModele->enregistrerAppartement($_SESSION['appart_temp']);
                
                        if ($resultatEnregistrement) {
                            // Réinitialiser l'appartement temporaire
                            $monModele->resetAppartementTemp($_SESSION['utilisateur']->getId());
                            $_SESSION['appart_temp'] = array();
                            
                            header('Location: ../view/v_compte-annonce.php');
                            exit;
                        } else {
                            // Rediriger vers une page d'erreur en cas d'échec d'enregistrement
                            print_r($_SESSION['appart_temp'])  ;
                            exit;
                        }
                    } else {
                        // Rediriger vers une page d'erreur si la session utilisateur n'est pas définie
                        header("Location: ../view/v_erreur.php");
                        exit;
                    }
                    break;
                
            default:
                header("Location: ../view/v_erreur.php");
                break;
        }
    }
    

    $monModele = new ModeleDonnees('lecture');
    $donnees = $monModele->getAppartementTempUtilisateur($_SESSION['utilisateur']->getId());
    $appart_temp = new Appartement(
        $donnees['numappart_temp'],
        $donnees['step'],
        $donnees['rue'],
        $donnees['arrondisse'],
        $donnees['etage'],
        $donnees['typappart'],
        $donnees['prix_loc'],
        $donnees['prix_charg'],
        $donnees['ascenseur'],
        $donnees['preavis'],
        $donnees['date_libre'],
        $donnees['id_utilisateur']
    );
    $_SESSION['appart_temp'] = $appart_temp;
    if (isset($_POST['form-continu']) ) {
        switch ($_SESSION['appart_temp']->getStep())
    {
        case 0:
            header("Location: ../view/v_depot-annonce-structure.php");
            exit;
            break;
        case 1:
            header("Location: ../view/v_depot-annonce-location.php");
            exit;
            break;
        case 2:
            header("Location: ../view/v_depot-annonce-access.php");
            exit;
            break;
        case 3:
            header("Location: ../view/v_depot-annonce-prix.php");
            exit;
            break;
        case 4:
                header("Location: ../view/v_depot-annonce-confirmation.php");
                exit;
                break;
        default:
            header("Location: ../view/v_erreur.php");
            exit;
}
    }

    
    if (isset($_POST['form-reset'])) {
       
        $monModele = new ModeleDonnees('ecriture');
        if (isset($_SESSION['utilisateur'])) {
            $monModele->resetAppartementTemp($_SESSION['utilisateur']->getId());
            $_SESSION['appart_temp'] = array();
            header('Location: ../view/v_depot-annonce-structure.php');
            exit;
        } else {
            header('Location: ../view/v_erreur.php'); 
            exit;
        }
    }

    if (!empty($_SESSION['appart_temp']->getTypappart())) 
        {
            header("Location: ../view/alert-annonece-nontermine.php");
            exit;
        }
    else
    {
        header("Location: ../view/v_depot-annonce-structure.php");
        exit;
    }



    
}else {
    header('Location: ../view/v_erreur.php');
    exit();
}
?>
