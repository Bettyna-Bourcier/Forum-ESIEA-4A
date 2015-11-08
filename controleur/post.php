<?php
session_start();
    include_once('../modele/post.php');
    include_once('../modele/utilisateurs.php');
    
    inserer_post($_POST['contenu'], $_GET['sujet'], infos_utilisateur($_SESSION['identifiant'])['id']);
    header('Location: ../vues/sujet.php?sujet='.$_GET['sujet']);