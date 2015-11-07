<?php
/*
 * action [ADMIN] pour supprimer un sujet
 *
 *  parametres : GET
 *      sujet => nom du fichier à supprimer
 */

session_start();
include_once('../lib/utilisateur.php');

// on vérifie que l'utilisateur est un admin
if(isAdmin()) {
    // on supprime le fichier qui représente le sujet
    unlink('../sujets/' . $_GET['sujet']);

    header('Location: ../vues/admin.php');
} else {
    header('Location: ../vues/pagePerso.php?erreur=true');
}