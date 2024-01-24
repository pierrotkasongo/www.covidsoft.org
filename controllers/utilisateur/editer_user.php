<?php
session_start();
include '../../models/db.php';
if (isset($_POST['envoyer'])) {
    function check_input($value)
    {
        $data = htmlentities($value);
        $data = htmlspecialchars($value);
        $data = trim($value);
        $data = strtolower($value);
        return $data;
    }
    $nom =    check_input($_POST['nom']);
    $postnom = check_input($_POST['postnom']);
    $mail =   check_input($_POST['mail']);
    $telephone =  check_input($_POST['telephone']);
    if (isset($_GET['id']) and !empty($_GET['id'])) {
        $id = $_GET['id'];
    }
    $requete = "SELECT * FROM utilisateur WHERE id= '$id'";
    $execution = $connexion->query($requete);
    $data = $execution->fetch(PDO::FETCH_OBJ);
    $extentions = array('jpg', 'jpeg', 'png');
    $extentionsUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
    $photo = $mail . '.' . $extentionsUpload;
    if (in_array($extentionsUpload, $extentions)) {
        unlink("../../publics/images/utilisateurs/$data->photo");
        $chemin = "../../publics/images/utilisateur/" . $mail . "." . $extentionsUpload;
        $deplacement = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
    } else {
        header("location:../../views/utilisateur/profil.php?error=Erreur de modification, La photo doit être au format jpg, jpeg, png");
        exit();
    }
    $requete = "UPDATE utilisateur SET
    nom='$nom',
    postnom='$postnom',
    mail='$mail',
    telephone='$telephone',
    photo='$photo'
    WHERE id='$id'";
    $execution = $connexion->exec($requete);
    header("location:../../views/utilisateur/profil.php?succes=Le profil est modifié avec succès");
}
