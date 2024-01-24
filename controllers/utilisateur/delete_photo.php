<?php
session_start();
include '../../models/db.php';
include '../../models/ajout.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$data = pat($id, $connexion);
unlink("../../publics/images/patients/$data->photo");
header("location:delete_patient.php?id=$id");
