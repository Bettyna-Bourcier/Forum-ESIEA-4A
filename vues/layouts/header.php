<?php
    include_once('../lib/utilisateur.php') ;
    include_once('../modele/admin.php');
    include_once ('../modele/utilisateurs.php');
?>

<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="../vues/pagePerso.php">Forum</a>
        </div>

        <?php if(preg_match('/vues\/connexion.php/',$_SERVER['REQUEST_URI'])) { ?>
        <!-- Collect the nav links, forms, and other content for toggling -->

        <?php } if(isConnected()) { ?>
            <ul class="nav navbar-nav">
                <li><a href="../vues/pagePerso.php">Page perso</a></li>
                <li><a href="../vues/sujets.php">Sujets</a></li>
                <?php
                if(is_admin($_SESSION['identifiant']) == true) { ?>
                    <li><a href="../vues/admin.php">Administration</a></li>
                <?php } ?>
            </ul>
            <div class="navbar-right">
                <a href="../controleur/deconnexion.php" class="btn btn-default navbar-btn">Deconnexion</a>
            </div>
        <?php } ?>
    </div><!-- /.container -->
</nav>