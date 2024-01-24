<?php
function user_existe($mail, $telephone, $photo, $connexion)
{
    $requete = "SELECT * FROM utilisateur WHERE mail= '$mail' OR telephone='$telephone' OR photo='$photo'";
    $execution = $connexion->query($requete);
    $data = $execution->fetch(PDO::FETCH_OBJ);
    return $data;
}
function insertion_users($nom, $postnom, $password, $mail, $service, $hopital, $photo, $telephone)
{
    $requete = "INSERT INTO utilisateur 
    (
        nom,
        postnom,
        password,
        mail,
        service,
        hopital,
        photo,
        telephone,
        date
    )
    
    VALUES (
        '$nom',
        '$postnom',
        '$password',
        '$mail',
        '$service',
        '$hopital',
        '$photo',
        '$telephone',
        Now()
    )";
    return $requete;
}