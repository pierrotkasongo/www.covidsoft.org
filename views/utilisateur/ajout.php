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
        <link rel="stylesheet" href="../../publics/css/utilisateur/ajout.css">
        <link rel="shortcut icon" href="../../publics/Images/img-covid/img-icon.png" type="image/x-icon">
        <title>Enregistrement</title>
    </head>

    <body>

        <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
            <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="dashboard.php">CovidSoft RDC</a>
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
                                    <p class="name"> <?= ucfirst($data['nom']) . "@user" ?><br><?= ucfirst($data['hopital']) ?> </p>
                                </div>
                            </li>
                            <li class="nav-item"><a class="nav-link inactif" aria-current="page" href="dashboard.php"><i class="far fa-list-alt"></i> Tableau de bord</a></li>
                            <li class="nav-item"><a class="nav-link actif" aria-current="page" href="ajout.php"> <i class="fas fa-list-ol"></i> Enregistrements</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="profil.php"><i class="far fa-user"></i> Mon espace</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="discussion.php"><i class="far fa-comments"></i> Messages</a></li>
                            <li class="nav-item"><a class="nav-link inactif" href="../../controllers/deconnexion.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
                        </ul>
                    </div>
                </nav>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom mb-4">
                        <p class="mb-2"><i class="far fa-hospital"></i> Hopital : <?= ucfirst($data['hopital']) ?></p>
                        <p class="d-flex mb-2"><span class="led"></span>
                            <?php
                            setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
                            date_default_timezone_set('Africa/Kinshasa');
                            echo ucfirst(utf8_encode(strftime('%A %d %B %Y, %H:%M')));
                            ?>
                        </p>
                    </div>
                    <div class="container pb-2">
                        <form action="../../controllers/utilisateur/ajout.php" method="post" enctype="multipart/form-data" class="pt-4">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nom</label>
                                        <input type="text" class="form-control" placeholder="nom" name="nom" min="1" max="50" autocomplete="off" pattern="[a-zA-Z -]*" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Post-nom</label>
                                        <input type="text" class="form-control" placeholder="Post-nom" name="postnom" min="1" max="50" autocomplete="off" pattern="[a-zA-Z -]*" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" placeholder="Prénom" name="prenom" min="1" max="50" autocomplete="off" pattern="[a-zA-Z -]*" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Age</label>
                                        <input type="number" class="form-control" placeholder="Age" min="1" max="200" name="age" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Sexe</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="sexe" required>
                                            <option value="masculin">Masculin</option>
                                            <option value="feminin">Feminin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control" placeholder="Date de naissance" name="datenaiss" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Lieu de naissance</label>
                                        <input type="text" class="form-control" placeholder="Lieu de naissance" name="lieunaiss" autocomplete="off" min="1" max="50" pattern="[a-zA-Z -]*" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Ville</label>
                                        <input type="text" class="form-control" placeholder="Ville actuelle" name="ville" min="1" max="50" autocomplete="off" pattern="[a-zA-Z -]*" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Commune</label>
                                        <input type="text" class="form-control" placeholder="Commune" name="commune" min="1" max="50" autocomplete="off" pattern="[a-zA-Z -]*" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Quartier</label>
                                        <input type="text" class="form-control" placeholder="Quartier" name="quartier" min="1" max="50" autocomplete="off" pattern="[a-zA-Z -]*" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Avenue</label>
                                        <input type="text" class="form-control" placeholder="Avenue" name="avenue" min="1" max="50" autocomplete="off" pattern="[a-zA-Z -]*" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">N° Domicile</label>
                                        <input type="number" class="form-control" placeholder="N° Domicile" name="domicile" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-bottom mb-3">
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Nationalité</label>
                                        <input type="text" class="form-control" placeholder="Nationalité" name="nationalite" autocomplete="off" pattern="[a-zA-Z -]*" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Addresse mail</label>
                                        <input type="email" class="form-control" placeholder="Addresse mail" name="mail" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Téléphone</label>
                                        <input type="tel" class="form-control" placeholder="Téléphone" name="telephone" min="10" max="10" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">Photo</label>
                                        <input type="file" class="form-control" name="photo" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="Statut">Situation familliale</label>
                                    <select class="form-select form-select-sm mt-3" aria-label=".form-select-sm example" name="situation_fam" id="categ" required>
                                        <option value="marié">Marié</option>
                                        <option value="célibataire">Célibataire</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="Statut">Statut</label>
                                    <select class="form-select form-select-sm mt-3" aria-label=".form-select-sm example" name="categorie" id="categ" required>
                                        <option value="civile">Civile</option>
                                        <option value="militaire">Militaire</option>
                                        <option value="policier">Policier</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-xs btn-primary mb-2 float-end mx-2" name="envoyer">Enregistrer</button>
                            <button type="reset" class="btn btn-xs btn-danger mb-2 float-end">Annuler</button>
                        </form>
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
    <?php header('location:erreur.php'); ?>
<?php } ?>