<?php
session_start();
include '../../models/db.php';
include '../../models/admin.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$data = users($id, $connexion);
unlink("../../publics/images/utilisateur/$data->photo");
header("location:delete_user.php?id=$id");
