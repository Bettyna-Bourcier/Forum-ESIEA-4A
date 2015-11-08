<?php
session_start();
?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8"/>
        <title>Mot de passe oublié</title>

    </head>

    <body>
        <?php include_once('layouts/header.php'); ?>
        <div class="container"
             <p>Rentrez votre identifiant et votre adresse email afin de changer de mot de passe.</p>
            <!--Formulaire permettant le changement de mot de passe en cas d'oublie.-->
            <form class="form-horizontal" action="../controleur/mdp.php" method="POST">


                <div class="form-group">
                    <label for="identifiant" class="col-sm-2 control-label">Identifiant</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="identifiant" name="identifiant">
                    </div>
                </div>


                <div class="form-group">
                    <label for="identifiant" class="col-sm-2 control-label">Adresse email</label>
                    <div class="col-sm-10">
                        <input type="text" id="identifiant" class="form-control" name="adresseEmail">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default" name="mdpOublieSubmit">Valider</button>
                    </div>                  
                </div>   

            </form>
        </div>
    </body>

</html>