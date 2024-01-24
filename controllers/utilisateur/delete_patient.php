<?php
session_start();
include '../../models/db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$connexion->query("DELETE FROM patient WHERE id='$id'");
header("location:../../views/utilisateur/dashboard.php?succes=Le patient est supprimé avec succès");