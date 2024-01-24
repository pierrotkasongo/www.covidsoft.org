<?php
session_start();
include '../../models/db.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$connexion->query("DELETE FROM utilisateur WHERE id='$id'");
header("location:../../views/administrateur/admin.php?succes=L'utilisateur est supprimé avec succès");