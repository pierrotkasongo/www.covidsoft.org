<?php
function nombre_users($connexion)
{
    $req = "SELECT COUNT(*) as nombre FROM utilisateur WHERE service='utilisateur'";
    $execution = $connexion->query($req);
    $data = $execution->fetch(PDO::FETCH_OBJ);
    return $data;
}
function nombre_all($connexion, $resultat)
{
    $req = "SELECT COUNT(*) as nombre FROM patient WHERE resultat='$resultat'";
    $execution = $connexion->query($req);
    $data = $execution->fetch(PDO::FETCH_OBJ);
    return $data;
}
function Affichage_users($connexion)
{
    $req = "SELECT * FROM utilisateur WHERE service='utilisateur' ORDER BY nom ASC";
    $execution = $connexion->query($req);
    return $execution;
}
function search_users($q, $connexion)
{
    $req = "SELECT * FROM utilisateur WHERE nom LIKE '%$q%' OR postnom LIKE '%$q%' ORDER BY nom ASC ";
    $execution = $connexion->query($req);
    return $execution;
}
function afficher_membre_admin($connexion, $id)
{
    $req = "SELECT * FROM utilisateur WHERE id <> '$id' ORDER BY nom ASC";
    $execution = $connexion->query($req);
    return $execution;
}
function users($id, $connexion)
{
    $req = "SELECT * FROM utilisateur WHERE id='$id' ";
    $execution = $connexion->query($req);
    $data = $execution->fetch(PDO::FETCH_OBJ);
    return $data;
}