<?php
session_start();
include '../models/db.php'; 
include '../models/index.php';
function check_input($value)
{
    $data = htmlentities($value);
    $data = htmlspecialchars($value);
    $data = trim($value);
    $data = strtolower($value);
    return $data;
}
if (isset($_POST['authentification'])) {
    $mail = check_input($_POST['mail']);
    $password = check_input($_POST['password']);
    $service = check_input($_POST['service']);
    $data = authentification($connexion, $mail, $password, $service);
    if ($data) {
        switch ($data->service) {
            case 'administration':
                $_SESSION['id'] = $data->id;
                $_SESSION['hopital'] = $data->hopital;
                header('location:../views/administrateur/admin.php');
                break;
            case 'utilisateur':
                $_SESSION['id'] = $data->id;
                $_SESSION['hopital'] = $data->hopital;
                header('location:../views/utilisateur/dashboard.php');
                break;
        }
    }
    else{
        header('location:../index.php?erreur=Identifiants incorrects');
    }
}