<?php
/**
 * Created by PhpStorm.
 * User: Bettyna
 * Date: 12/09/2015
 * Time: 13:47
 */
session_start();
include_once('../lib/utilisateur.php');
include_once('../modele/sujets.php');
?>
<!DOCTYPE html>

<html>

    <head>
        <meta charset="utf-8"/>
        <title>Forum PHP</title>

    </head>

    <body>
        <?php include_once('layouts/header.php'); ?>
        <div class="container">
            <header>
                <p><h3>Bienvenue sur le forum !</h3></p>
                <?php
                if (!isConnected()) {
                    echo 'Pour voir les sujets, veuillez vous <a href="connexion.php">connecter</a>.';
                }
                ?>

            </header>


            <!-- Liste de tous les sujets -->
            <?php
            if (isActif()) {

                $sujets = recuperation_sujets();
                ?>
                <table class="table table-striped">
                    <tr>
                        <th>Sujet</th>
                        <th>Auteur</th>
                    </tr>
                    <?php
                    foreach ($sujets as $sujet) {
                        ?>                        
                        <tr>
                            <td>
                                <a href="sujet.php?sujet=<?php echo $sujet['id'] ?>"><?php echo $sujet['titre'] ?></a>
                            </td>
                            <td><?php echo $sujet['identifiant'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>

                </table>

                <h4>Création d'un sujet</h4>
                <?php
                if (isset($_GET['erreur']) && $_GET['erreur'] == 'creation_sujet') {
                    echo '<div class="alert alert-danger" role="alert">'
                    . '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span>'
                    . ' Veuillez renseigner un titre et un contenu lors de la création du sujet.'
                    . '</div>';
                }
                ?>
                <form class="form-horizontal" action="../controleur/sujets.php" method="post">

                    <div class="form-group">
                        <label for="titre_sujet" class="col-sm-2 control-label">Titre du sujet</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nom_sujet" id="titre_sujet">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="contenu_sujet" class="col-sm-2 control-label">Contenu du sujet</label>
                        <div class="col-sm-10">
                            <textarea name="contenu_sujet" class="form-control" rows="10" id="contenu_sujet"></textarea>
                            <button type="submit" class="btn btn-default">Valider</button>
                        </div>
                    </div>
                </form>
                <?php
            } else { // utilisateur pas actif
                if (isConnected()) {
                    echo '<p>Votre compte doit être validé par un administrateur afin de voir les sujets et de pouvoir participer.</p>';
                } else {
                    echo '<p>Vous n\'êtes pas encore membre du forum ?
					Vous pouvez vous inscrire en cliquant sur ce lien : <a href="inscription.php">inscription</a></p>';
                }
            }
            ?>
        </div>
    </body>

</html>