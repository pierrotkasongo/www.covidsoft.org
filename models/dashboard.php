<?php
function nombre_enregistrement($hopital, $connexion)
{
    $req = "SELECT COUNT(*) as nombre FROM patient WHERE hopital='$hopital'";
    $execution = $connexion->query($req);
    $data = $execution->fetch(PDO::FETCH_OBJ);
    return $data;
}
function nombre($hopital, $cat, $connexion)
{
    $req = "SELECT COUNT(*) as nombre FROM patient WHERE hopital='$hopital' AND resultat = '$cat'";
    $execution = $connexion->query($req);
    $data = $execution->fetch(PDO::FETCH_OBJ);
    return $data;
}
function Affichage_patient($hopital, $cat, $connexion)
{
    $req = "SELECT * FROM patient WHERE hopital = '$hopital' AND resultat = '$cat' ORDER BY nom ASC";
    $execution = $connexion->query($req);
    return $execution;
}
function search($hopital, $q, $connexion)
{
    $req = "SELECT * FROM patient WHERE hopital='$hopital' AND nom LIKE '%$q%' OR postnom LIKE '%$q%' OR prenom LIKE '%$q%' ORDER BY nom ASC ";
    $execution = $connexion->query($req);
    return $execution;
}