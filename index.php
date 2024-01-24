<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="publics/css/bootstrap.css">
    <link rel="stylesheet" href="publics/css/index.css">
    <link rel="shortcut icon" href="publics/Images/img-covid/img-icon.png" type="image/x-icon">
    <title>Se connecter</title>
</head>

<body>
    <div class="container">
        <div class="container content">
            <div class="row">
                <div class="col-md-6"><img class="img-fluid" src="publics/Images/img-covid/img-index.jpg"></div>
                <div class="col-md-6">
                    <div class="entete">
                        <p>Vous êtes membre de l'équipe de riposte contre le covid-19 <span>Se connecter</span></p>
                    </div>
                    <form action="controllers/index.php" method="post">
                        <?php if (isset($_GET['erreur']) and !empty($_GET['erreur'])) { ?>
                            <div class="alert alert-danger text-center"><?= $_GET['erreur'] ?></div>
                        <?php } ?>
                        <div class="mb-4"><input type="email" class="form-control" autocomplete="off" placeholder="Jeanpierre@example.com" name="mail" required></div>
                        <div class="mb-4"><input type="password" class="form-control" autocomplete="off" placeholder="votre mot de passe" name="password" required></div>
                        <div class="mb-4">
                            <select class="form-select" name="service">
                                <option value="administration">Administration</option>
                                <option value="utilisateur">Utilisateur</option>
                            </select>
                        </div>
                        <div class="mb-2 mt-4"><input type="submit" class="form-control  text-white envoyer" value="Se connecter" name="authentification"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="publics/JavaScripts/all.js"></script>
    <script src="publics/JavaScripts/jquery.js"></script>
    <script src="publics/JavaScripts/bootstrap.min.js"></script>
</body>

</html>