<?php
session_start();
include_once('../lib/utilisateur.php');
if (isConnected()) {
    header('Location: ../vues/pagePerso.php');
}
?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8"/>
        <title>Connexion forum</title>
    </head>

    <body>
        <?php
        include_once('layouts/header.php');
        $pseudo = '';
        if (isset($_COOKIE['pseudo'])) {
            $pseudo = $_COOKIE['pseudo'];
        }
        ?>
        <div class="container">

            <h3>Connection au forum</h3>

            <!-- Formulaire permettant de remplir les informations obligatoires pour la connection au forum.-->
            <form method='POST' action="../controleur/connexion.php">
                <div class="form-group">
                    <label for="identifiant">Identifiant</label>
                    <input type='text' class="form-control" placeholder="Identifiant" id="identifiant" name='pseudoIdentification' value=<?php echo $pseudo ?>>
                </div>

                <div class="form-group">
                    <label for="mdp">Mot de passe</label>
                    <input type='password' class="form-control" id="mdp" placeholder="Mot de passe" name='mdpIdentification'></p>
                </div>    
                <button type="submit" name="connectionBouton" class="btn btn-default">Se connecter</button>
            </form>
            <div>
                <p>Mot de passe oublié ? <a href="../vues/mdpOublie.php">Cliquez ici</a></p>

                <p>Pas encore inscrit ? <a href="../vues/inscription.php">Cliquez ici</a> </p>
            </div>
        </div>
    </body>

</html>