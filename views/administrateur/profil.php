<?php
session_start();
include '../../models/db.php';
?>
<?php if (isset($_SESSION['id'])) { ?>
    <?php
    $id = $_SESSION['id'];
    $data = Affichage($id, $connexion);
    ?>
    <!doctype html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../publics/css/bootstrap.css">
        <link rel="stylesheet" href="../../publics/css/utilisateur/profil.css">
        <link rel="shortcut icon" href="../../publics/Images/img-covid/img-icon.png" type="image/x-icon">
        <title>Profil</title>
    </head>

    <body>

        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="admin.php">Covidsoft RDC</a>
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
                                    <p class="name"><?= ucfirst($data['nom'])  ?>@user <br><?= ucfirst($data['hopital']) ?> </p>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link inactif" aria-current="page" href="admin.php"><i class="far fa-list-alt"></i> Tableau de bord</a></li>
                            <li class="nav-item"><a class="nav-link actif" href="profil.php"><i class="far fa-user"></i> Mon espace</a></li>
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
                    <div class="space-img">
                        <div class="ligne"></div>
                        <img src="../../publics/images/utilisateur/<?= $data['photo'] ?>" class="rounded-circle me-2 img-circle">
                        <p class="text-center lead text-name-complet"> <?= ucfirst($data['nom']) ?> <?= ucfirst($data['postnom']) ?></p>
                    </div>
                    <div class="container content mb-3">
                        <?php if (isset($_GET['error'])) { ?>
                            <div class="alert alert-danger text-center" role="alert"><?= $_GET['error'] ?></div>
                        <?php } elseif (isset($_GET['succes'])) { ?>
                            <div class="alert alert-success text-center"><?= $_GET['succes'] ?></div>
                        <?php } ?>

                        <div class="mb-2 border-bottom p-1">Nom : <?= ucfirst($data['nom']) ?> <i class="fas fa-file-signature"></i></div>
                        <div class="mb-2 border-bottom p-1">Post-nom : <?= ucfirst($data['postnom']) ?> <i class="fas fa-file-signature"></i></div>
                        <div class="mb-2 border-bottom p-1">Rôle : Utilisateur <i class="fas fa-hospital-user"></i></div>
                        <div class="mb-2 border-bottom p-1">Service : Unité de veille <i class="fas fa-hospital-user"></i></div>
                        <div class="mb-2 border-bottom p-1">hôpital : <?= ucfirst($data['hopital']) ?> <i class="fas fa-hospital-user"></i></div>
                        <div class="mb-2 border-bottom p-1">Adresse mail : <?= $data['mail'] ?> <i class="fas fa-at"></i></div>
                        <div class="mb-2 border-bottom p-1">Téléphone : <?= $data['telephone'] ?> <i class="fas fa-tty"></i></div>
                        <div class="p-2">Date d'inscription : <?= $data['date'] ?> <i class="fas fa-calendar-alt"></i></div>
                        <button type="button" class="btn btn-primary mt-4 mb-3 float-end btn-modal" data-bs-toggle="modal" data-bs-target="#exampleModal">Editer</button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editer mon profil</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="../../controllers/administrateur/mod_admin.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
                                        <div class="container mb-3 mt-3">
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Nom</label>
                                                <input type="text" class="form-control" placeholder="nom" name="nom" min="1" max="50" autocomplete="off" pattern="[a-zA-Z ]*" value="<?= $data['nom'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Post-nom</label>
                                                <input type="text" class="form-control" placeholder="Post-nom" name="postnom" min="1" max="50" autocomplete="off" pattern="[a-zA-Z ]*" value="<?= $data['postnom'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Addresse mail</label>
                                                <input type="email" class="form-control" placeholder="Addresse mail" name="mail" autocomplete="off" value="<?= $data['mail'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Téléphone</label>
                                                <input type="tel" class="form-control" placeholder="Téléphone" name="telephone" min="10" max="10" autocomplete="off" value="<?= $data['telephone'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlInput1" class="form-label">Photo</label>
                                                <input type="file" class="form-control" name="photo" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="envoyer">Enregistrement</button>
                                        </div>
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