<?php
function Affichage_pat($id, $connexion)
{
    $requete = $connexion->prepare("SELECT * FROM patient WHERE id = ? ");
    $requete->execute(array($id));
    $requete = $requete->fetch();
    return $requete;
}
function Affichage_centre($hopital, $connexion)
{
    $requete = "SELECT DISTINCT hopital FROM utilisateur WHERE hopital <> '$hopital' AND hopital <> 'Direction générale'";
    $execution = $connexion->query($requete);
    return $execution;
}
function resultat($resultat, $id)
{
    $requete = "UPDATE patient SET resultat='$resultat' WHERE id='$id'";
    return $requete;
}
function transfert($centre, $id)
{
    $requete = "UPDATE patient SET hopital='$centre' WHERE id='$id'";
    return $requete;
}