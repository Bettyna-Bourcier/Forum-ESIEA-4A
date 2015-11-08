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
        <header>
            <p><h3>Bienvenue sur le forum du club des développeurs et IT pro!</h3></p>
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
        <ul>
            <?php
            foreach ($sujets as $sujet) {
                ?>
                <li><a href="sujet.php?sujet=<?php echo $sujet['id'] ?>"><?php echo $sujet['titre'] ?></a></li>
                <?php
            }
            ?>

        </ul>

        <h2>Création d'un sujet</h2>
        <?php
        if (isset($_GET['erreur']) && $_GET['erreur'] == 'creation_sujet') {
            echo '<p>Veuillez renseigner un titre et un contenu lors de la création du sujet.</p>';
        }
        ?>
        <form action="../controleur/sujets.php" method="post">
            <p>Titre du sujet : <input type="text" name="nom_sujet"></p>
            <p>Contenu du sujet : <textarea name="contenu_sujet"></textarea></p>
            <input type="submit">
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
</body>

</html>