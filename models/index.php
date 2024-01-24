<?php 
    function authentification($connexion, $mail, $password, $service)
    {
        $requete = "SELECT * FROM utilisateur WHERE mail= '$mail' AND password='$password' AND service='$service'";
        $execution = $connexion->query($requete);
        $data = $execution->fetch(PDO::FETCH_OBJ);
        return $data;
    }