<?php
session_start();
if (!isset($_SESSION['identifiant'])) { // on redirige sur la page de connexion si pas connecté
    header('Location: ../vues/connexion.php?erreur=true&message=pas connecte');
}
?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8"/>
        <title>Espace personnel</title>
    </head>

    <body>
        <?php
        include_once('layouts/header.php');
        $utilisateur = infos_utilisateur($_SESSION['identifiant']);
        ?>
        <div class="container">
            <p><h2>Bienvenue sur votre espace personnel <?php echo $_SESSION['identifiant']; ?>.</h2></p>


        <?php
        if (isset($_GET['erreur']) && $_GET['erreur'] == 'image_size') {
            echo '<div class="alert alert-danger" role="alert">'
            . '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'
            . '<span class="sr-only">Error:</span>'
            . ' La taille de l\'image ne doit pas être supérieure à 150x150 et ne doit pas dépasser 2Mo.'
            . '</div>';
        }
        if (is_actif($_SESSION['identifiant'])) {
            echo '<p>Votre compte est validé.</p>';
        } else {
            echo '<p>Votre inscription au forum doit être valider par les administrateurs.</p>';
        }
        
        ?>

        <?php
        // si une photo est présente pour l'utilsateur, on l'affiche
        if (file_exists('../utilisateurs/' . $_SESSION['identifiant'] . '/image.jpeg')) {
            echo "<img class='img-thumbnail' src='../utilisateurs/" . $_SESSION['identifiant'] . "/image.jpeg?" . time() . "' />"; // time() retourne le nombre de s depuis le 01/01/1970 => éviter le cache navigateur
        }
        ?>
        <h3>Changer ma photo de profil</h3>
        <!--Ajout d'une image de profil-->
        <form action="../controleur/pagePerso.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="file">
                <p class="help-block">Taille max 150x150 et 2Mo</p>
            </div>
            <button type="submit" class="btn btn-default" name="imageSubmit">Valider</button>

        </form>

        <!--Ajout d'une signature-->

        <form action="../controleur/pagePerso.php" method="POST">
            <h3>Changer ma signature</h3>
            <div class="form-group">
                <textarea class="form-control" rows="3" name="textAreaSignature"><?php echo $utilisateur['signature'] ?></textarea>
            </div>           
            <button type="submit" class="btn btn-default" name="signatureSubmit">Valider</button>
        </form>


        <!-- Modification des informations personnelles de l'utilisateur -->
        <form class="form-horizontal" method="POST" action="../controleur/pagePerso.php">
            <h3>Changer mes informations personnelles</h3>
            <div class="form-group">
                <label for="mail" class="col-sm-2 control-label">Adresse email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="mail" value=<?php echo $utilisateur['adresse_mail'] ?>>
                </div>

            </div>


            <div class="form-group">
                <label for="mail_secours" class="col-sm-2 control-label">Adresse email de secours</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="mail_secours" name="emailSecours"  value=<?php echo $utilisateur['adresse_mail_secours'] ?>>
                </div>
            </div>


            <div class="form-group">
                <label for="nom" class="col-sm-2 control-label">Nom</label>
                <div class="col-sm-10">
                    <input type="text" name="nom"  class="form-control" id="nom" value=<?php echo $utilisateur['nom'] ?>>
                </div>     
            </div>



            <div class="form-group">
                <label for="prenom" class="col-sm-2 control-label">Prénom</label>
                <div class="col-sm-10">
                    <input type = "text" class="form-control" name="prenom" id="prenom" value=<?php echo $utilisateur['prenom'] ?>>
                </div>              
            </div>

            <div class="form-group">
                <label for="age" class="col-sm-2 control-label">Âge</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="age"  value=<?php echo $utilisateur['age'] ?>>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="boutonModif">Valider</button>
                </div>
            </div>

        </form>

        <h3>Changer mon mot de passe</h3>
        
        <?php
        if (isset($_GET['erreur']) && $_GET['erreur'] == 'mdp') {
            echo '<div class="alert alert-danger" role="alert">'
            . '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>'
            . '<span class="sr-only">Error:</span>'
            . ' Le mot de passe et sa vérification doivent être identitiques.'
            . '</div>';
        }
        ?>
        <form class="form-horizontal" method="POST" action="../controleur/pagePerso.php">            
            <div class="form-group">
                <label for="mdp" class="col-sm-2 control-label">Mot de passe</label>
                <div class="col-sm-10">
                    <input class="form-control" id="mdp" type="password" name="mdpModif">
                </div>
            </div>

            <div class="form-group">
                <label for="mdp_verif" class="col-sm-2 control-label">Vérification de mot de passe</label>
                <div class="col-sm-10">
                    <input id="mdp_verif" type="password" name="verifMdpModif" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="mdpModifSubmit">Valider</button>
                </div>
            </div>         
        </form>
    </div>
</body>

</html>