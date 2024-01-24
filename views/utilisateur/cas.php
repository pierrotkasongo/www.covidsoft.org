<?php
session_start();
include '../../models/db.php';
include '../../models/dashboard.php';
?>
<?php if (isset($_SESSION['id'])) { ?>
    <?php
    $id = $_SESSION['id'];
    $data = Affichage($id, $connexion);
    if ($_SESSION['hopital']) {
        $hopital = $_SESSION['hopital'];
    }
    ?>
    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../publics/css/bootstrap.css">
        <link rel="stylesheet" href="../../publics/css/utilisateur/dashboard.css">
        <link rel="shortcut icon" href="../../publics/Images/img-covid/img-icon.png" type="image/x-icon">
        <title>Cas</title>
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
                                    <p class="name"><?= ucfirst($data['nom']) ?>@user<br><?= ucfirst($data['hopital']) ?></p>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link actif" aria-current="page" href="dashboard.php"><i class="far fa-list-alt"></i> Tableau de bord</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="profil.php"><i class="far fa-user"></i> Mon espace</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="discussion.php"><i class="far fa-comments"></i> Messages</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="../../controllers/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom mb-4">
                        <p class="mb-2 center"><i class="far fa-hospital"></i> Hopital : <?= ucfirst($data['hopital']) ?></p>
                        <p class="d-flex mb-2">
                            <span class="led"></span>
                            <?php
                            setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                            date_default_timezone_set('Africa/Kinshasa');
                            echo ucfirst(utf8_encode(strftime('%A %d %B %Y, %H:%M')));
                            ?>
                        </p>
                    </div>
                    <?php
                    $data1 = nombre_enregistrement($hopital, $connexion);
                    $data2 = nombre($hopital, 'positive', $connexion);
                    $data3 = nombre($hopital, 'décédée', $connexion);
                    $data4 = nombre($hopital, 'guérie', $connexion);
                    ?>
                    <div class="container content mb-3">
                        <div class="dash4">
                            <i class="fas fa-list-ol"></i>
                            <span class="valeur"><?= $data1->nombre ?></span>
                            <span class="dash-text">Enregistrements</span>
                        </div>
                        <div class="dash1">
                            <i class="fas fa-clipboard-list"></i>
                            <span class="valeur"><?= $data2->nombre ?></span>
                            <span class="dash-text">Positives</span>
                        </div>
                        <div class="dash2">
                            <i class="fas fa-procedures"></i>
                            <span class="valeur"> <?= $data3->nombre ?></span>
                            <span class="dash-text">Décès</span>
                        </div>
                        <div class="dash3">
                            <i class="fa fa-heartbeat"></i>
                            <span class="valeur"> <?= $data4->nombre ?></span>
                            <span class="dash-text">Guéries</span>
                        </div>
                    </div>
                    <div class="container">
                        <form class="d-flex mb-4 mx-1">
                            <input class="form-control me-2" type="search" placeholder="Effectuez une recherche" name="q" id="input">
                            <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <p class="mx-1">Categorie : </p>
                                <div class="container groupe">
                                    <div class="div"><a href="dashboard.php">Tableau de bord</a></div>
                                    <div class="div"><a href=" cas.php" class="active">Cas</a></div>
                                    <div class="div"><a href="gueris.php">Guéries</a></div>
                                    <div class="div"><a href="deces.php">Décès</a></div>
                                    <a class="btn btn-primary ajout" href="ajout.php"><i class="fa fa-user-plus" aria-hidden="true"></i></a><span class="ajout_pat"></span>
                                </div>
                            </div>
                            <div class="col-md-10 tab">
                                <?php if (isset($_GET['erreur'])) { ?>
                                    <div class="alert alert-danger" role="alert"><?= $_GET['erreur'] ?></div>
                                <?php } elseif (isset($_GET['succes'])) { ?>
                                    <div class="alert alert-success"><?= $_GET['succes'] ?></div>
                                <?php } ?>
                                <div class="table-responsive">
                                    <table class="table  table-sm">
                                        <tbody>
                                            <tr class="th">
                                                <td class="title">Avatar</td>
                                                <td class="title">Nom</td>
                                                <td class="title">Postnom</td>
                                                <td class="title">Prénom</td>
                                                <td class="title">Sexe</td>
                                                <td class="title">Age</td>
                                                <td class="title">Commune</td>
                                                <td class="title">Statut</td>
                                                <td class="title">Taitement</td>
                                            </tr>
                                            <?php
                                            $execution = Affichage_patient($hopital, 'positive', $connexion);
                                            if (isset($_GET['q']) and !empty($_GET['q'])) {
                                                $q = $_GET['q'];
                                                $execution = search($hopital, $q, $connexion);
                                            }
                                            ?>
                                            <?php if ($execution->rowCount() > 0) { ?>
                                                <?php while ($values = $execution->fetch(PDO::FETCH_OBJ)) { ?>
                                                    <tr>
                                                        <td><img src="../../publics/images/patients/<?= $values->photo ?>" class="rounded-circle me-2 circle"></td>
                                                        <td><?= ucfirst($values->nom) ?></td>
                                                        <td><?= $values->postnom ?></td>
                                                        <td><?= $values->prenom ?></td>
                                                        <td><?= $values->sexe ?></td>
                                                        <td><?= $values->age ?></td>
                                                        <td><?= $values->commune ?></td>
                                                        <td><?= $values->categorie ?></td>
                                                        <td><a href="patient_positif.php?id_pat=<?= $values->id ?>"><i class="fas fa-chalkboard-teacher"></i></a></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php  } else { ?>
                                                <div class="containe rerror-img">
                                                    <img class="img-fluid" src="../../publics/images/img-covid/img-search.jpg" alt="" width="180" height="180">
                                                </div>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
    <?php header('location:../../erreur.php'); ?>
<?php } ?>