<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Changement mot de passe</title>
    </head>

    <body>
        <?php
        session_start();
        include_once('layouts/header.php');
        ?>
        <div class="container">
            <p>Votre nouveau mot de passe est le suivant : <mark><?php  echo $_SESSION['new_mdp'] ?></mark></p>
            <p><a href='../vues/connexion.php'>retour vers la page de connexion</a></p>
            <?php         
                    unset($_SESSION['new_mdp']); // Détruit new_mdp qui est en session
            ?>
        </div>
    </body>
</html>


