<?php
session_start();
include '../../models/db.php';
include  '../../models/discussion.php';
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}
function check_input($value)
{
    $data = htmlentities($value);
    $data = htmlspecialchars($value);
    $data = trim($value);
    return $data;
}
if (isset($_POST['envoyer_admin'])) {
    $message = check_input($_POST['message']);
    if (($_GET['id']) and !empty($_GET['id'])) {
        $id_admin = $_GET['id'];
    }
    $execution = insertion_message($id, $id_admin, $message, $connexion);
    header('location:../../views/administrateur/discussion.php');
}
if (isset($_POST['envoyer_users'])) {
    $message = check_input($_POST['message']);
    if (($_GET['id']) and !empty($_GET['id'])) {
        $user_id = $_GET['id'];
    }
    $execution = insertion_message($id, $user_id, $message, $connexion);
    header('location:../../views/administrateur/discussions.php?id='.$user_id);
}
