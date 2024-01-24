<?php
$host = 'localhost';
$dbname = 'covidsoft';
$username = 'root';
$password = '';
try {
    $connexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {

    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
}
function Affichage($id, $connexion)
{
    $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE id = ? ");
    $requete->execute(array($id));
    $requete = $requete->fetch();
    return $requete;
}
$connexion->query("DELETE FROM patient WHERE resultat='négative'");
function afficher_admin($connexion)
{
    $req = "SELECT * FROM utilisateur WHERE service='administration '";
    $execution = $connexion->query($req);
    return $execution;
}

function afficher_membre($hopital, $connexion, $id)
{
    $req = "SELECT * FROM utilisateur WHERE hopital='$hopital' AND id <> '$id' ORDER BY nom ASC";
    $execution = $connexion->query($req);
    return $execution;
}
function afficher($id_user, $connexion)
{
    $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE id = ? ");
    $requete->execute(array($id_user));
    $requete = $requete->fetch();
    return $requete;
}

