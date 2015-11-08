<?php

session_start();
include_once('../modele/sujets.php');
include_once('../modele/utilisateurs.php');

if (!empty($_POST['nom_sujet']) && !empty($_POST['contenu_sujet'])) {
    creation_sujet ($_POST['nom_sujet'], $_POST['contenu_sujet'], infos_utilisateur ($_SESSION['identifiant'])['id']);
    } elseif (isset($_GET['supprimer'])) {
        supprimer_sujet($_GET['supprimer']);
        header('Location: ../vues/admin.php');
} else {
    header('Location: ../vues/sujets.php?erreur=creation_sujet');
}


