<?php
/*
 * action [ADMIN] pour activer un utilisateur
 *
 * parametres : GET
 *      pseudo => pseudo de l'utilisateur
 *
 */

session_start();
include_once('../lib/utilisateur.php');

// on vérifie que l'utilisateur est un admin
if (isAdmin()) {
    // on crée le fichier is_actif.txt dans le dossier de l'utilisateur
    active_utilisateur($_GET['pseudo']);

    header('Location: ../vues/admin.php');
} else { // si pas admin on redirige sur la page perso
    header('Location: ../vues/pagePerso.php?erreur=true');
}

function active_utilisateur($nom_utilisateur) {
    $monFichier = fopen('../utilisateurs/' . $nom_utilisateur . '/is_actif.txt', 'a+');
fclose($monFichier);
}