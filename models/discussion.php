<?php
function insertion_message($auteur, $destinataire, $message, $connexion)
{
    $requete = $connexion->prepare("INSERT INTO discussion (auteur, destinataire, message) VALUES (?,?,?)");
    $requete->execute(array($auteur, $destinataire, $message));
    return $requete;
}
function afficher_message($connexion, $auteur, $destinataire)
{
    $req = "SELECT * FROM discussion WHERE auteur='$auteur' AND destinataire='$destinataire' OR auteur='$destinataire' AND destinataire='$auteur'";
    $execution = $connexion->query($req);
    return $execution;
}

