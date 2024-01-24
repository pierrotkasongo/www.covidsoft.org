<?php
session_start();
include '../../models/db.php';
include '../../models/patient.php';
?>
<?php if (isset($_SESSION['id'])) { ?>
    <?php
    $id = $_SESSION['id'];
    if (isset($_SESSION['hopital'])) {
        $hopital = $_SESSION['hopital'];
    }
    if (isset($_GET['id_pat']) and !empty($_GET['id_pat'])) {
        $id_pat = $_GET['id_pat'];
    }
    $data = Affichage($id, $connexion);
    $data1 = Affichage_pat($id_pat, $connexion);
    if ($data1) {
    } else {
        header("location:dashboard.php");
    }
    ?>
    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../publics/css/bootstrap.css">
        <link rel="stylesheet" href="../../publics/css/utilisateur/patient.css">
        <link rel="shortcut icon" href="../../publics/Images/img-covid/img-icon.png" type="image/x-icon">
        <title>Dossier patient</title>
    </head>

    <body>

        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="dashboard.php">Covidsoft RDC</a>
            <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav">
                <div class="nav-item text-nowrap sing-out">
                    <a class="nav-link px-3" href="../../controllers/deconnexion.php">Déconnexion</a>
                </div>
            </div>
        </header>
        <div class="container-fluid">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                    <div class="position-sticky pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <div class="d-flex bg">
                                    <a class="nav-link" href="profil.php"><img src="../../publics/images/utilisateur/<?= $data['photo'] ?>" class="rounded-circle me-2"></a>
                                    <p class="name"><?= ucfirst($data['nom'])  ?>@user<br><?= ucfirst($data['hopital']) ?> </p>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link inactif" aria-current="page" href="dashboard.php"><i class="far fa-list-alt"></i> Tableau de bord</a></li>
                            <li class="nav-item"><a class="nav-link actif" aria-current="page" href="dashboard.php"><i class="far fa-folder-open"></i> Dossier patient</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="profil.php"><i class="far fa-user"></i> Mon espace</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="discussion.php"><i class="far fa-comments"></i> Messages</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="../../controllers/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom mb-4">
                        <p class="mb-2 center">
                            <i class="far fa-hospital"></i>
                            Hopital : <?= ucfirst($data['hopital']) ?>
                        </p>
                        <p class="d-flex mb-2">
                            <span class="led"></span>
                            <?php
                            setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                            date_default_timezone_set('Africa/Kinshasa');
                            echo ucfirst(utf8_encode(strftime('%A %d %B %Y, %H:%M')));
                            ?>
                        </p>
                    </div>
                    <div class="space-img"></div>
                    <div class="container content mb-2">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger text-center" role="alert"><?= $_GET['error'] ?></div>
                        <?php } elseif (isset($_GET['succes'])) { ?>
                            <div class="alert alert-success text-center"><?= $_GET['succes'] ?></div>
                        <?php } ?>
                        <p class="info-title">Toutes les informations</p>
                        <div class="row all-info">
                            <div class="container">
                                <div class="mb-2 border-bottom p-1">Nom : <?= ucfirst($data1['nom']) ?></div>
                                <div class="mb-2 border-bottom p-1">Post-nom : <?= ucfirst($data1['postnom']) ?></div>
                                <div class="mb-2 border-bottom p-1">Prénom : <?= ucfirst($data1['prenom']) ?></div>
                                <div class="mb-2 border-bottom p-1">Age : <?= ucfirst($data1['age']) ?></div>
                                <div class="mb-2 border-bottom p-1">Sexe : <?= ucfirst($data1['sexe']) ?></div>
                                <div class="mb-2 border-bottom p-1">Date de naissance : <?= ucfirst($data1['datenaiss']) ?></div>
                                <div class="mb-2 border-bottom p-1">Lieu de naissance : <?= ucfirst($data1['lieunaiss']) ?></div>
                                <div class="mb-2 border-bottom p-1">Ville Actuelle : <?= ucfirst($data1['ville']) ?></div>
                                <div class="mb-2 border-bottom p-1">Commune : <?= ucfirst($data1['commune']) ?></div>
                                <div class="mb-2 border-bottom p-1">Quatier : <?= ucfirst($data1['quartier']) ?></div>
                                <div class="mb-2 border-bottom p-1">Avenue : <?= ucfirst($data1['avenue']) ?></div>
                                <div class="mb-2 border-bottom p-1">Numero domicile : <?= ucfirst($data1['domicile']) ?></div>
                                <div class="mb-2 border-bottom p-1">Nationalité : <?= ucfirst($data1['nationalite']) ?></div>
                                <div class="mb-2 border-bottom p-1">mail : <?= ucfirst($data1['mail']) ?></div>
                                <div class="mb-2 border-bottom p-1">Numéro téléphone : <?= ucfirst($data1['telephone']) ?></div>
                                <div class="mb-2 border-bottom p-1">Situation familliale : <?= ucfirst($data1['situation']) ?></div>
                                <div class="mb-2 border-bottom p-1">Statut : <?= ucfirst($data1['categorie']) ?></div>
                                <div class="p-2">Date : <?= ucfirst($data1['dateenreg']) ?></div>
                            </div>
                        </div>
                        <p class="mt-4 info-title">Traitements</p>
                        <div class="container mt-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <a name="" id="" class="btn btn-danger" href="../../controllers/utilisateur/delete_photo.php?id=<?= $id_pat ?>" role="button">Supprimer</a>
                                </div>
                                <div class="col-md-2">
                                    <a name="" id="" class="btn btn-primary" href="../../controllers/utilisateur/editer_patient.php?id=<?= $id_pat ?>" role="button">Editer</a>
                                </div>
                                <div class="col-md-4">
                                    <form action="../../controllers/utilisateur/ajout.php?id=<?= $id_pat ?>" method="post" class="d-flex mb-4 mx-1">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="resultat" required>
                                            <option value="">Resultat examen</option>
                                            <option value="positive">Positif</option>
                                            <option value="negative">négatif</option>
                                        </select>
                                        <button class="btn btn-outline-success mx-2" type="submit" name=""><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <?php
                                    $data2 = Affichage_centre($hopital, $connexion);
                                    ?>
                                    <form action="../../controllers/utilisateur/ajout.php?id=<?= $id_pat ?>" method="post" class="d-flex mb-4 mx-1">
                                        <form action="../../controllers/utilisateur/ajouter_patient.php?id=<?= $id_pat ?>" method="post" class="d-flex mb-4 mx-1">
                                            <select class="form-select dece" aria-label="Disabled" disabled>
                                                <option selected>Aucun transfert</option>
                                            </select>
                                        </form>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="../../publics/JavaScripts/all.js"></script>
        <script src="../../publics/JavaScripts/jquery.js"></script>
        <script src="../../publics/JavaScripts/bootstrap.min.js"></script>
    </body>

    </html>
<?php } else { ?>
    <?php header("location:erreur.php") ?>
<?php } ?>