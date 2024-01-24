<?php
session_start();
include '../../models/db.php';
include '../../models/dashboard.php';
include '../../models/discussion.php';
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
        <link rel="stylesheet" href="../../publics/css/utilisateur/discussion.css">
        <link rel="shortcut icon" href="../../publics/Images/img-covid/img-icon.png" type="image/x-icon">
        <title>Discussion</title>
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
                                    <p class="service-name"> <?= ucfirst($data['nom']) ?>@user<br><?= ucfirst($data['hopital']) ?></p>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link inactif" aria-current="page" href="dashboard.php"><i class="far fa-list-alt"></i> Tableau de bord</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="profil.php"><i class="far fa-user"></i> Mon espace</a></li>
                            <li class="nav-item"><a class="nav-link actif" href="discussion.php"><i class="far fa-comments"></i> Messages</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="../../controllers/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom mb-4">
                        <p class="mb-2 center"><i class="far fa-hospital"></i> Hopital : <?= ucfirst($data['hopital']) ?></p>
                        <p class="d-flex mb-2"><span class="led"></span>
                            <?php
                            setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                            date_default_timezone_set('Africa/Kinshasa');
                            echo ucfirst(utf8_encode(strftime('%A %d %B %Y, %H:%M')));
                            ?>
                        </p>
                    </div>
                    <div class="container">
                        <?php
                        $execution = afficher_admin($connexion);
                        $admin =  $execution->fetch(PDO::FETCH_OBJ);
                        ?>
                        <div class="row">
                            <div class="col-md-3 users">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <div class=" border-bottom">
                                    <a class="nav-link" href="discussion.php">
                                        <div class="d-flex">
                                            <div class="mx-2">
                                                <img src="../../publics/images/utilisateur/<?= $admin->photo ?>" class="rounded-circle img-circle me-2">
                                            </div>
                                            <div>
                                                <p> <?= $admin->nom . " " . $admin->postnom ?> <br><?= ucfirst($admin->service) ?></p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                                $h = $data['hopital'];
                                $execution = afficher_membre($h, $connexion, $id);
                                ?>
                                <?php while ($values = $execution->fetch(PDO::FETCH_OBJ)) { ?>
                                    <div class=" border-bottom">
                                        <a class="nav-link" href="discussions.php?id=<?= $values->id ?>">
                                            <div class="d-flex">
                                                <div class="mx-2">
                                                    <img src="../../publics/images/utilisateur/<?= $values->photo ?>" class="rounded-circle img-circle me-2">
                                                </div>
                                                <div>
                                                    <p> <?= $values->nom . " " . $values->postnom ?> <br><?= $values->service ?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                            if (isset($_GET['id']) and !empty($_GET['id'])) {
                                $user_id = $_GET['id'];
                            }
                            $user = afficher($user_id, $connexion);
                            ?>
                            <div class="col-md-8">
                                <div class="form-bar">
                                    <div class="d-flex">
                                        <div class="mx-2">
                                            <img src="../../publics/images/utilisateur/<?= $user['photo'] ?>" class="rounded-circle img-circle-banner me-2">
                                        </div>
                                        <div>
                                            <p class="banner-text"> <?= $user['nom'] ?> <br><?= $user['service'] ?></p>
                                        </div>
                                    </div>
                                    <div class="float-end"> <i class="fa fa-cog" aria-hidden="true"></i> </div>
                                </div>
                                <div class="container pane-message">
                                    <div class="message p-2">
                                        <?php
                                        $execution = afficher_message($connexion, $id, $user_id)
                                        ?>
                                        <?php while ($messages = $execution->fetch(PDO::FETCH_OBJ)) { ?>
                                            <?php if ($messages->destinataire === $user_id) { ?>
                                                <div class="auteur"><?= $messages->message; ?> <i class="fas fa-check-double"></i></div>
                                            <?php } elseif ($messages->destinataire === $id) { ?>
                                                <div class="destinataire"><?= $messages->message; ?></div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <form action="../../controllers/utilisateur/discussion.php?id=<?= $user['id']?>" method="post" class="d-flex">
                                    <textarea name="message" id="input" class="form-control" rows="3" required="required" placeholder="Contacter <?=  $user['nom'] ?>"></textarea>
                                    <button class="btn btn-outline-success bout" type="submit" name="envoyer_users"> <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="../../publics/javaScripts/bootstrap.min.js"></script>
        <script src="../../publics/javaScripts/jquery.js"></script>
        <script src="../../publics/javaScripts/all.js"></script>
    </body>

    </html>
<?php } else { ?>
    <?php header("location:../../erreur.php") ?>
<?php } ?>