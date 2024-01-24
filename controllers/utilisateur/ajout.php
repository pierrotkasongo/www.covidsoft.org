<?php
session_start();
include '../../models/db.php';
include '../../models/ajout.php';
include '../../models/patient.php';
function check_input($value)
{
    $data = htmlentities($value);
    $data = htmlspecialchars($value);
    $data = trim($value);
    $data = strtolower($value);
    return $data;
}
if (isset($_POST['envoyer'])) {
    $nom =    check_input($_POST['nom']);
    $postnom = check_input($_POST['postnom']);
    $prenom = check_input($_POST['prenom']);
    $age = check_input($_POST['age']);
    $sexe = check_input($_POST['sexe']);
    $datenaiss =  check_input($_POST['datenaiss']);
    $lieunaiss =  check_input($_POST['lieunaiss']);
    $ville = check_input($_POST['ville']);
    $commune =   check_input($_POST['commune']);
    $quartier =  check_input($_POST['quartier']);
    $avenue =  check_input($_POST['avenue']);
    $domicile =   check_input($_POST['domicile']);
    $nationalite =   check_input($_POST['nationalite']);
    $mail =   check_input($_POST['mail']);
    $telephone =  check_input($_POST['telephone']);
    $situation =  check_input($_POST['situation_fam']);
    $categorie =   check_input($_POST['categorie']);
    $extentions = array('jpg', 'jpeg', 'png');
    $extentionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
    if (isset($_SESSION['hopital'])) {
        $hopital = $_SESSION['hopital'];
    }
    $photo = $mail . '.' . $extentionsUpload;
    $data = patient_existe($mail, $telephone, $photo, $connexion);
    if ($data) {
        header("location:../../views/utilisateur/dashboard.php?erreur=Le patient existe déjà dans la base de données !");
    } else {
        if (in_array($extentionsUpload, $extentions)) {
            $chemin = "../../publics/images/patients/" . $mail . "." . $extentionsUpload;
            $deplacement = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
            if (!$deplacement) {
                header("location:../../views/utilisateur/dashboard.php?erreur=Problème d'importation");
                exit();
            }
        } else {
            header("location:../../views/utilisateur/dashboard.php?erreur=La photo doit etre au format jpg, jpeg, png");
            exit();
        }
        $requete = insertion_patient($nom, $postnom, $prenom, $age, $sexe, $datenaiss, $lieunaiss, $ville, $commune, $quartier, $avenue, $domicile, $nationalite, $mail, $telephone, $photo, $situation, $categorie, $hopital);
        $execution = $connexion->exec($requete);
        header("location:../../views/utilisateur/dashboard.php?succes=Le patient est enregistré avec succès");
    }
}
if (isset($_POST['update'])) {
    $nom =    check_input($_POST['nom']);
    $postnom = check_input($_POST['postnom']);
    $prenom = check_input($_POST['prenom']);
    $age = check_input($_POST['age']);
    $sexe = check_input($_POST['sexe']);
    $datenaiss =  check_input($_POST['datenaiss']);
    $lieunaiss =  check_input($_POST['lieunaiss']);
    $ville = check_input($_POST['ville']);
    $commune =   check_input($_POST['commune']);
    $quartier =  check_input($_POST['quartier']);
    $avenue =  check_input($_POST['avenue']);
    $domicile =   check_input($_POST['domicile']);
    $nationalite =   check_input($_POST['nationalite']);
    $mail =   check_input($_POST['mail']);
    $telephone =  check_input($_POST['telephone']);
    $situation =  check_input($_POST['situation_fam']);
    $categorie =   check_input($_POST['categorie']);
    $extentions = array('jpg', 'jpeg', 'png');
    $extentionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
    if (isset($_SESSION['hopital'])) {
        $hopital = $_SESSION['hopital'];
    }
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_pat = $_GET['id'];
    }
    $data = pat($id_pat, $connexion);
    unlink("../../publics/images/patients/$data->photo");
    $photo = $mail . '.' . $extentionsUpload;
    if (in_array($extentionsUpload, $extentions)) {
        $chemin = "../../publics/images/patients/" . $mail . "." . $extentionsUpload;
        $deplacement = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
        if (!$deplacement) {
            header("location:../../views/utilisateur/dashboard.php?error=Erreur d'importation");
            exit();
        }
    } else {
        header("location:location:../../views/utilisateur/dashboard.php?error=La photo doit être au format jpg, jpeg, png");
        exit();
    }
    $requete = update_patient($nom, $postnom, $prenom, $age, $sexe, $datenaiss, $lieunaiss, $ville, $commune, $quartier, $avenue, $domicile, $nationalite, $mail, $telephone, $photo, $situation, $categorie, $id_pat);
    $execution = $connexion->exec($requete);
    header("location:../../views/utilisateur/dashboard.php?succes=Informations modifiées avec succès");
}
if (isset($_POST['resultat']) and !empty($_POST['resultat'])) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_pat = $_GET['id'];
    }
    $resultat = $_POST['resultat'];
    $requete = resultat($resultat, $id_pat);
    $execution = $connexion->exec($requete);
    header("location:../../views/utilisateur/dashboard.php?succes=Examination avec succès");
}
if (isset($_POST['transfert']) and !empty($_POST['transfert'])) {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id_pat = $_GET['id'];
    }
    $centre = $_POST['transfert'];
    $requete = transfert($centre, $id_pat);
    $execution = $connexion->exec($requete);
    header("location:../../views/utilisateur/dashboard.php?succes=Le patient est transféré avec succès");
}
