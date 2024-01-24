<?php
session_start();
include '../../models/db.php';
include '../../models/ajout.php';
include '../../models/ajout_user.php';
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
    $password = check_input($_POST['password']);
    $mail =  check_input($_POST['mail']);
    $hopital =  check_input($_POST['hopital']);
    $service =  check_input($_POST['service']);
    $telephone =  check_input($_POST['telephone']);
    $extentions = array('jpg', 'jpeg', 'png');
    $extentionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
    $photo = $mail . '.' . $extentionsUpload;
    $data = user_existe($mail, $telephone, $photo, $connexion);
    if ($data) {
        header("location:../../views/administrateur/admin.php?erreur=L'utilisateur existe déjà dans la base de donnée !");
    } else {
        if (in_array($extentionsUpload, $extentions)) {
            $chemin = "../../publics/images/utilisateur/" . $mail . "." . $extentionsUpload;
            $deplacement = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
            if (!$deplacement) {
                header("location:../../views/administrateur/admin.php?erreur=Problème d'importation");
                exit();
            }
        } else {
            header("location:../../views/administrateur/admin.php?erreur=La photo doit etre au format jpg, jpeg, png");
            exit();
        }
        $requete =insertion_users($nom, $postnom, $password, $mail, $service, $hopital, $photo, $telephone);
        $execution = $connexion->exec($requete);
        header("location:../../views/administrateur/admin.php?succes=Le patient est enregistré avec succès");
    }
}
