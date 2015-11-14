<?php
/**
 * Created by PhpStorm.
 * User: Bettyna
 * Date: 12/09/2015
 * Time: 13:54
 */
?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8"/>
        <title>Connexion forum</title>
    </head>
    <body>
        <?php include_once('layouts/header.php'); ?>


        <div class="container">
            <h3>Inscription</h3>
            <?php
            if (isset($_GET['erreur']) && $_GET['erreur'] == 'inscription') {
                ?>
                <div class = "alert alert-danger" role = "alert">
                <span class = "glyphicon glyphicon-exclamation-sign" aria-hidden = "true"></span>
                <span class = "sr-only">Error:</span>
                Veuillez remplir correctement tous les champs. 
                </div>
            <?php
            }
            ?>
            <form class="form-horizontal" method="POST" action="../controleur/inscription.php">
                <h4>Tous les renseignements demandés sont obligatoires.</h4>

                <div class="form-group">
                    <label for="identifiant" class="col-sm-2 control-label">Identifiant</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" id="identifiant" name="pseudo"/>
                    </div>       
                </div>

                <div class="form-group">
                    <label for="mdp" class="col-sm-2 control-label">Mot de passe</label>
                    <div class="col-sm-10">
                        <input class="form-control" id="mdp" type="password" name="mdp"/>
                    </div>
                </div>


                <div class="form-group">
                    <label for="mdp_verif" class="col-sm-2 control-label">Vérification mot de passe</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="mdp_verif" name="verifMdp"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Adresse email</label>
                    <div class="col-sm-10">
                        <input type="email" id="email" class="form-control" name="mail"/>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="validate">Valider</button>
                    </div>
                </div>       

            </form>         
        </div>
    </body>
</html>