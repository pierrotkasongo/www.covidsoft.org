<?php
function patient_existe($mail, $telephone, $photo, $connexion)
{
    $requete = "SELECT * FROM patient WHERE mail= '$mail' OR telephone='$telephone' OR photo='$photo'";
    $execution = $connexion->query($requete);
    $data = $execution->fetch(PDO::FETCH_OBJ);
    return $data;
}
function insertion_patient($nom, $postnom, $prenom, $age, $sexe, $datenaiss, $lieunaiss, $ville, $commune, $quartier, $avenue, $domicile, $nationalite, $mail, $telephone, $photo, $situation, $categorie, $hopital)
{
    $requete = "INSERT INTO patient 
    (
        nom,
        postnom,
        prenom,
        age,
        sexe,
        datenaiss,
        lieunaiss,
        ville,
        commune,
        quartier,
        avenue,
        domicile,
        nationalite,
        mail,
        telephone,
        photo,
        situation,
        categorie,
        resultat,
        hopital,
        dateenreg
    )
    
    VALUES (
        '$nom',
        '$postnom',
        '$prenom',
        '$age',
        '$sexe',
        '$datenaiss',
        '$lieunaiss',
        '$ville',
        '$commune',
        '$quartier',
        '$avenue',
        '$domicile',
        '$nationalite',
        '$mail',
        '$telephone',
        '$photo',
        '$situation',
        '$categorie',
        'suspecte',
        '$hopital',
        Now()
    )";
    return $requete;
}
function pat($id, $connexion)
{
    $req = "SELECT * FROM patient WHERE id='$id' ";
    $execution = $connexion->query($req);
    $data = $execution->fetch(PDO::FETCH_OBJ);
    return $data;
}
function update_patient($nom, $postnom, $prenom, $age, $sexe, $datenaiss, $lieunaiss, $ville, $commune, $quartier, $avenue, $domicile, $nationalite, $mail, $telephone, $photo, $situation, $categorie, $id_pat)
{
    $requete = "UPDATE patient SET
            nom='$nom',
            postnom='$postnom',
            prenom='$prenom',
            age='$age',
            sexe='$sexe',
            datenaiss='$datenaiss',
            lieunaiss='$lieunaiss',
            ville='$ville',
            commune='$commune',
            quartier='$quartier',
            avenue='$avenue',
            domicile='$domicile',
            nationalite='$nationalite',
            mail='$mail',
            telephone='$telephone',
            photo='$photo',
            categorie='$categorie',
            situation='$situation'
            WHERE id='$id_pat'";
    return $requete;
}
